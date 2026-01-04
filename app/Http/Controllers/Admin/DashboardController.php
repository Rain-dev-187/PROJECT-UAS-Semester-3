<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Opini;
use App\Models\SuaraPembaca;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_berita' => Berita::count(),
            'berita_published' => Berita::published()->count(),
            'total_opini' => Opini::count(),
            'opini_pending' => Opini::where('status', 'pending')->count(),
            'total_suara' => SuaraPembaca::count(),
            'suara_pending' => SuaraPembaca::where('status', 'pending')->count(),
            'total_users' => User::count(),
        ];

        $latestBerita = Berita::latest()->take(5)->get();
        $latestOpini = Opini::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestBerita', 'latestOpini'));
    }
}
