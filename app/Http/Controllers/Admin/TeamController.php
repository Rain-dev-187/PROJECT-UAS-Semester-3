<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::orderBy('urutan')->paginate(10);
        return view('admin.team.index', compact('teams'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'npm' => 'nullable|max:20',
            'foto' => 'nullable|image|max:2048',
            'urutan' => 'integer',
        ]);

        $data = $request->only(['nama', 'npm', 'urutan']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('team', 'public');
        }

        Team::create($data);

        return redirect()->route('admin.team.index')->with('success', 'Anggota tim berhasil ditambahkan.');
    }

    public function edit(Team $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'npm' => 'nullable|max:20',
            'foto' => 'nullable|image|max:2048',
            'urutan' => 'integer',
        ]);

        $data = $request->only(['nama', 'npm', 'urutan']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('foto')) {
            if ($team->foto) {
                Storage::disk('public')->delete($team->foto);
            }
            $data['foto'] = $request->file('foto')->store('team', 'public');
        }

        $team->update($data);

        return redirect()->route('admin.team.index')->with('success', 'Anggota tim berhasil diperbarui.');
    }

    public function destroy(Team $team)
    {
        if ($team->foto) {
            Storage::disk('public')->delete($team->foto);
        }
        
        $team->delete();

        return redirect()->route('admin.team.index')->with('success', 'Anggota tim berhasil dihapus.');
    }
}
