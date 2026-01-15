<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Opini;
use App\Models\SuaraPembaca;

class UserPanelController extends Controller
{
    public function userPanel()
    {
        $user = auth()->user();

        // Opini stats and list - tampilkan semua opini (pending, approved, rejected)
        $opiniQuery = Opini::where('user_id', $user->id);
        $opinis = $opiniQuery->latest()->take(10)->get();
        $opiniCounts = [
            'total' => $opiniQuery->count(),
            'approved' => $opiniQuery->where('status', 'approved')->count(),
            'pending' => $opiniQuery->where('status', 'pending')->count(),
            'rejected' => $opiniQuery->where('status', 'rejected')->count(),
        ];

        // Suara Pembaca stats and list
        $suaraQuery = SuaraPembaca::where('email', $user->email);
        $suaraPembacas = $suaraQuery->latest()->take(10)->get();
        $suaraCounts = [
            'total' => $suaraQuery->count(),
            'approved' => $suaraQuery->where('status', 'approved')->count(),
            'pending' => $suaraQuery->where('status', 'pending')->count(),
            'rejected' => $suaraQuery->where('status', 'rejected')->count(),
        ];

        return view('Public.user_panel', compact('user', 'opinis', 'opiniCounts', 'suaraPembacas', 'suaraCounts'));
    }

    public function guestPanel()
    {
        return view('Public.guest_panel');
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view('Public.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|max:255',
            'nickname' => 'nullable|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'nickname' => $request->nickname,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('avatars', 'public');
            $data['photo'] = $path;
        }

        $user->update($data);

        // Refresh user data after update
        auth()->user()->refresh();

        // Redirect user to the appropriate panel depending on role
        if (auth()->user()->hasAnyRole(['super-admin','admin'])) {
            return redirect()->route('admin.dashboard')->with('success', 'Profil berhasil diperbarui.');
        }

        return redirect()->route('user.panel')->with('success', 'Profil berhasil diperbarui.');
    }

    public function editOpini(Opini $opini)
    {
        // Ensure user owns this opini
        if ($opini->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('Public.edit-opini', compact('opini'));
    }

    public function updateOpini(Request $request, Opini $opini)
    {
        // Ensure user owns this opini
        if ($opini->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required|min:100',
            'penulis_profesi' => 'nullable|max:100',
            'penulis_foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['judul', 'konten', 'penulis_profesi']);
        
        // Handle foto penulis jika ada upload baru
        if ($request->hasFile('penulis_foto')) {
            $data['penulis_foto'] = $request->file('penulis_foto')->store('opini/penulis', 'public');
        }

        // Reset status ke pending ketika di-update
        $data['status'] = 'pending';

        $opini->update($data);

        return redirect()->route('user.panel')->with('success', 'Opini berhasil diperbarui dan menunggu persetujuan admin.');
    }
}
