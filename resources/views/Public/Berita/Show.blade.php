@extends('layouts.public')

@section('title', $berita->judul . ' - PULSA')

@push('styles')
<style>
    .berita-header {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        padding: 60px 0;
        color: #fff;
    }
    
    .berita-header .kategori {
        display: inline-block;
        background: var(--accent);
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        margin-bottom: 15px;
    }
    
    .berita-header h1 {
        font-weight: 700;
        font-size: 2rem;
        line-height: 1.4;
    }
    
    .berita-header .meta {
        opacity: 0.8;
        font-size: 0.9rem;
    }
    
    .berita-content {
        background: #fff;
        border-radius: 15px;
        padding: 40px;
        margin-top: -30px;
        box-shadow: 0 5px 30px rgba(0,0,0,0.1);
    }
    
    .berita-content img {
        max-width: 100%;
        border-radius: 10px;
        margin-bottom: 25px;
    }
    
    .berita-content .content {
        font-size: 1.1rem;
        line-height: 1.9;
        color: #444;
        /* Ensure long content wraps and preserves newlines */
        overflow-wrap: break-word;
        word-break: break-word;
        white-space: pre-line;
    }
    
    .berita-content .content p { margin-bottom: 20px; }
    
    .share-buttons a {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        margin-right: 10px;
        transition: all 0.3s;
    }
    
    .share-buttons a:hover { transform: translateY(-3px); }
    .share-buttons .facebook { background: #3b5998; }
    .share-buttons .twitter { background: #1da1f2; }
    .share-buttons .whatsapp { background: #25d366; }
    
    .related-card {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        transition: all 0.3s;
    }
    
    .related-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.12);
    }
    
    .related-card img {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }
    
    .related-card .card-body { padding: 15px; }
    .related-card h6 a { color: var(--dark); text-decoration: none; }
    .related-card h6 a:hover { color: var(--primary); }
</style>
@endpush

@section('content')
    <div class="berita-header">
        <div class="container">
            <span class="kategori">{{ ucfirst($berita->kategori) }}</span>
            <h1>{{ $berita->judul }}</h1>
            <div class="meta mt-3">
                <span class="me-4"><i class="fas fa-user me-2"></i>{{ $berita->user->name ?? 'Admin' }}</span>
                <span class="me-4"><i class="fas fa-calendar me-2"></i>{{ $berita->published_at?->format('d F Y') ?? $berita->created_at->format('d F Y') }}</span>
                <span><i class="fas fa-eye me-2"></i>{{ $berita->views }} kali dibaca</span>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="berita-content">
                    @if($berita->gambar)
                        <img src="{{ Storage::url($berita->gambar) }}" alt="{{ $berita->judul }}" class="w-100">
                    @endif
                    
                    <div class="content">
                        {!! nl2br(e($berita->konten)) !!}
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="mb-3 mb-md-0">
                            <strong class="me-3">Bagikan:</strong>
                            <div class="share-buttons d-inline">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $berita->judul }}" target="_blank" class="twitter"><i class="fab fa-twitter"></i></a>
                                <a href="https://wa.me/?text={{ $berita->judul }} {{ url()->current() }}" target="_blank" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                        <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="berita-content">
                    <h5 class="mb-4"><i class="fas fa-newspaper me-2 text-accent"></i>Berita Terkait</h5>
                    
                    @forelse($related as $item)
                        <div class="related-card mb-3">
                            @include('partials.image-url', ['path' => $item->gambar])
                            <img src="{{ $url ?? 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=300&h=150&fit=crop' }}" alt="{{ $item->judul }}">
                            <div class="card-body">
                                <h6><a href="{{ route('berita.show', $item->slug) }}">{{ Str::limit($item->judul, 50) }}</a></h6>
                                <small class="text-muted"><i class="fas fa-calendar me-1"></i>{{ $item->created_at->format('d M Y') }}</small>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Tidak ada berita terkait.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
