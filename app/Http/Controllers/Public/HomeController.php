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
        // Require authentication to submit an opini. Redirect guests to registration.
        if (! auth()->check()) {
            return redirect()->route('register');
        }

        return view('public.kirim-opini');
    }

    public function storeOpini(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required|min:100',
            'penulis_nama' => 'required|max:100',
            'penulis_profesi' => 'nullable|max:100',
            'penulis_foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['judul', 'konten', 'penulis_nama', 'penulis_profesi']);
        
        // Jika user login dan tidak upload foto baru, gunakan foto dari profil user
        if ($request->hasFile('penulis_foto')) {
            $data['penulis_foto'] = $request->file('penulis_foto')->store('opini/penulis', 'public');
        } elseif (auth()->check() && auth()->user()->photo) {
            $data['penulis_foto'] = auth()->user()->photo;
        } elseif ($request->filled('penulis_foto')) {
            // Dari hidden input untuk auth users
            $data['penulis_foto'] = $request->input('penulis_foto');
        }

        $data['user_id'] = auth()->id() ?? 1;
        
        // Jika user sudah login, langsung approved. Jika guest, pending
        $data['status'] = auth()->check() ? 'approved' : 'pending';

        Opini::create($data);

        return redirect()->route('home')->with('success', auth()->check() ? 'Opini Anda berhasil dipublikasikan.' : 'Opini Anda berhasil dikirim dan menunggu persetujuan.');
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
