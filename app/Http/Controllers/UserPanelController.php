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
        // Admin users get admin profile view
        if ($user->hasAnyRole(['super-admin', 'admin'])) {
            return view('admin.profile', compact('user'));
        }
        return view('Public.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|max:255',
            'nickname' => 'nullable|max:100',
            'profesi' => 'nullable|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'nickname' => $request->nickname,
            'profesi' => $request->profesi,
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
}
