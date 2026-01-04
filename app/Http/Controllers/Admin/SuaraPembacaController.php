<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuaraPembaca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuaraPembacaController extends Controller
{
    public function index()
    {
        $suaras = SuaraPembaca::latest()->paginate(10);
        return view('admin.suara-pembaca.index', compact('suaras'));
    }

    public function show(SuaraPembaca $suaraPembaca)
    {
        return view('admin.suara-pembaca.show', compact('suaraPembaca'));
    }

    public function destroy(SuaraPembaca $suaraPembaca)
    {
        if ($suaraPembaca->foto) {
            Storage::disk('public')->delete($suaraPembaca->foto);
        }
        
        $suaraPembaca->delete();

        return redirect()->route('admin.suara-pembaca.index')->with('success', 'Suara pembaca berhasil dihapus.');
    }

    public function approve(SuaraPembaca $suaraPembaca)
    {
        $suaraPembaca->update(['status' => 'approved']);
        return back()->with('success', 'Suara pembaca berhasil disetujui.');
    }

    public function reject(SuaraPembaca $suaraPembaca)
    {
        $suaraPembaca->update(['status' => 'rejected']);
        return back()->with('success', 'Suara pembaca berhasil ditolak.');
    }
}
