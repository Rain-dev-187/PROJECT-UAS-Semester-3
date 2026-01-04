<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Opini;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OpiniController extends Controller
{
    public function index()
    {
        $opinis = Opini::with('user')->latest()->paginate(10);
        return view('admin.opini.index', compact('opinis'));
    }

    public function create()
    {
        return view('admin.opini.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
            'penulis_nama' => 'required|max:100',
            'penulis_profesi' => 'nullable|max:100',
            'penulis_foto' => 'nullable|image|max:2048',
            'gambar' => 'nullable|image|max:2048',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $data = $request->only(['judul', 'konten', 'penulis_nama', 'penulis_profesi', 'status']);
        $data['user_id'] = auth()->id();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('opini', 'public');
        }

        if ($request->hasFile('penulis_foto')) {
            $data['penulis_foto'] = $request->file('penulis_foto')->store('opini/penulis', 'public');
        }

        Opini::create($data);

        return redirect()->route('admin.opini.index')->with('success', 'Opini berhasil ditambahkan.');
    }

    public function edit(Opini $opini)
    {
        return view('admin.opini.edit', compact('opini'));
    }

    public function update(Request $request, Opini $opini)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
            'penulis_nama' => 'required|max:100',
            'penulis_profesi' => 'nullable|max:100',
            'penulis_foto' => 'nullable|image|max:2048',
            'gambar' => 'nullable|image|max:2048',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $data = $request->only(['judul', 'konten', 'penulis_nama', 'penulis_profesi', 'status']);

        if ($request->hasFile('gambar')) {
            if ($opini->gambar) {
                Storage::disk('public')->delete($opini->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('opini', 'public');
        }

        if ($request->hasFile('penulis_foto')) {
            if ($opini->penulis_foto) {
                Storage::disk('public')->delete($opini->penulis_foto);
            }
            $data['penulis_foto'] = $request->file('penulis_foto')->store('opini/penulis', 'public');
        }

        $opini->update($data);

        return redirect()->route('admin.opini.index')->with('success', 'Opini berhasil diperbarui.');
    }

    public function destroy(Opini $opini)
    {
        if ($opini->gambar) {
            Storage::disk('public')->delete($opini->gambar);
        }
        if ($opini->penulis_foto) {
            Storage::disk('public')->delete($opini->penulis_foto);
        }
        
        $opini->delete();

        return redirect()->route('admin.opini.index')->with('success', 'Opini berhasil dihapus.');
    }

    public function approve(Opini $opini)
    {
        $opini->update(['status' => 'approved']);
        return back()->with('success', 'Opini berhasil disetujui.');
    }

    public function reject(Opini $opini)
    {
        $opini->update(['status' => 'rejected']);
        return back()->with('success', 'Opini berhasil ditolak.');
    }
}
