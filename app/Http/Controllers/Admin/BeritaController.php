<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::with('user')->latest()->paginate(10);
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'ringkasan' => 'nullable|max:500',
            'konten' => 'required',
            'kategori' => 'required',
            'gambar' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published,archived',
            'is_headline' => 'boolean',
        ]);

        $data = $request->only(['judul', 'ringkasan', 'konten', 'kategori', 'status']);
        $data['user_id'] = auth()->id();
        $data['is_headline'] = $request->has('is_headline');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        if ($request->status === 'published') {
            $data['published_at'] = now();
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'ringkasan' => 'nullable|max:500',
            'konten' => 'required',
            'kategori' => 'required',
            'gambar' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published,archived',
            'is_headline' => 'boolean',
        ]);

        $data = $request->only(['judul', 'ringkasan', 'konten', 'kategori', 'status']);
        $data['is_headline'] = $request->has('is_headline');

        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        if ($request->status === 'published' && !$berita->published_at) {
            $data['published_at'] = now();
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }
        
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
