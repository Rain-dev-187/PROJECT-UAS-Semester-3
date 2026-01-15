<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Opini;
use App\Models\Team;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $headlines = Berita::published()->headline()->latest()->take(5)->get();
        $beritas = Berita::published()->latest()->take(6)->get();
        $opinis = Opini::approved()->latest()->take(3)->get();
        $teams = Team::active()->get();

        return view('public.home', compact(
            'headlines',
            'beritas',
            'opinis',
            'teams'
        ));
    }

    public function berita()
    {
        $beritas = Berita::published()->latest()->paginate(12);
        return view('public.berita.index', compact('beritas'));
    }

    public function showBerita($slug)
    {
        $berita = Berita::where('slug', $slug)->published()->firstOrFail();
        $berita->increment('views');
        
        $related = Berita::published()
            ->where('id', '!=', $berita->id)
            ->where('kategori', $berita->kategori)
            ->take(3)
            ->get();

        return view('public.berita.show', compact('berita', 'related'));
    }

    public function opini()
    {
        $opinis = Opini::approved()->latest()->paginate(12);
        return view('public.opini.index', compact('opinis'));
    }

    public function showOpini($slug)
    {
        $opini = Opini::where('slug', $slug)->approved()->firstOrFail();
        return view('public.opini.show', compact('opini'));
    }

    /**
     * Show an opini by id. Allows owner to view their own opini regardless of approval.
     */
    public function showOpiniById($id)
    {
        $opini = Opini::where('id', $id)->firstOrFail();

        // Allow viewing if approved, or if the current user is the owner
        if ($opini->status !== 'approved') {
            if (! auth()->check() || auth()->id() !== $opini->user_id) {
                abort(404);
            }
        }

        return view('public.opini.show', compact('opini'));
    }

    public function tentang()
    {
        $teams = Team::active()->get();
        return view('public.tentang', compact('teams'));
    }

    public function kirimOpini()
    {
        // Allow both authenticated and guest users to submit opini
        return view('public.kirim-opini');
    }

    public function storeOpini(Request $request)
    {
        $isGuest = !auth()->check();

        // Validation rules untuk authenticated user dan guest
        $rules = [
            'judul' => 'required|max:255',
            'konten' => 'required|min:100',
            'penulis_nama' => 'required|max:100',
            'penulis_profesi' => 'nullable|max:100',
            'penulis_foto' => 'nullable|image|max:2048',
        ];

        // Untuk guest, email wajib diisi
        if ($isGuest) {
            $rules['penulis_email'] = 'required|email|max:100';
        } else {
            $rules['penulis_email'] = 'nullable|email|max:100';
        }

        $request->validate($rules);

        $data = $request->only(['judul', 'konten', 'penulis_nama', 'penulis_profesi', 'penulis_email']);
        
        // Handle foto penulis
        if ($request->hasFile('penulis_foto')) {
            $data['penulis_foto'] = $request->file('penulis_foto')->store('opini/penulis', 'public');
        } elseif (!$isGuest && auth()->user()->photo) {
            // Jika user login dan tidak upload foto baru, gunakan foto dari profil user
            $data['penulis_foto'] = auth()->user()->photo;
        }

        // Set user_id hanya jika user terautentikasi
        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }
        
        // Semua opini memerlukan manual approval dari admin
        $data['status'] = 'pending';

        Opini::create($data);

        return redirect()->route('home')->with('success', 'Opini Anda berhasil dikirim dan menunggu persetujuan dari admin.');
    }

    public function kirimSuara()
    {
        abort(404);
    }

    public function storeSuara(Request $request)
    {
        abort(404);
    }
}
