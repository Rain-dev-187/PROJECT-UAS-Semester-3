@extends('layouts.public')

@section('title', 'Berita - PULSA')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        padding: 60px 0;
        color: #fff;
        margin-bottom: 40px;
    }
    
    .page-header h1 { font-weight: 700; }
    
    .berita-card {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s;
        height: 100%;
    }
    
    .berita-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    }
    
    .berita-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    
    .berita-card .card-body { padding: 20px; }
    
    .berita-card .kategori {
        display: inline-block;
        background: var(--accent);
        color: #fff;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        margin-bottom: 10px;
    }
    
    .berita-card h5 {
        color: var(--dark);
        font-weight: 600;
        margin-bottom: 10px;
        line-height: 1.4;
    }
    
    .berita-card h5 a {
        color: inherit;
        text-decoration: none;
    }
    
    .berita-card h5 a:hover { color: var(--primary); }
    
    .berita-card .meta {
        font-size: 0.8rem;
        color: #888;
    }
    
    .berita-card .meta i { margin-right: 5px; }
</style>
@endpush

@section('content')
    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-newspaper me-3"></i>Berita Terbaru</h1>
            <p class="mb-0 opacity-75">Informasi dan berita terkini dari PULSA</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row g-4">
            @forelse($beritas as $berita)
                <div class="col-md-6 col-lg-4">
                    <div class="berita-card">
                            <img src="{{ $berita->gambar ? Storage::url($berita->gambar) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=400&h=200&fit=crop' }}" 
                             alt="{{ $berita->judul }}">
                        <div class="card-body">
                            <span class="kategori">{{ ucfirst($berita->kategori) }}</span>
                            <h5><a href="{{ route('berita.show', $berita->slug) }}">{{ Str::limit($berita->judul, 60) }}</a></h5>
                            <p class="text-muted small">{{ Str::limit($berita->ringkasan ?? strip_tags($berita->konten), 100) }}</p>
                            <div class="meta d-flex justify-content-between">
                                <span><i class="fas fa-calendar"></i>{{ $berita->published_at?->format('d M Y') ?? $berita->created_at->format('d M Y') }}</span>
                                <span><i class="fas fa-eye"></i>{{ $berita->views }} views</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada berita</h5>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $beritas->links() }}
        </div>
    </div>
@endsection
