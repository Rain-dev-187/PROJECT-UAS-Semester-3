@extends('layouts.public')

@section('title', 'Opini Publik - PULSA')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        padding: 60px 0;
        color: #fff;
        margin-bottom: 40px;
    }
    
    .opini-card-full {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s;
        height: 100%;
    }
    
    .opini-card-full:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    }
    
    .opini-card-full .card-body { padding: 25px; }
    
    .opini-card-full .author {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .opini-card-full .author img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 15px;
        border: 3px solid var(--light);
    }
    
    .opini-card-full .author-name { font-weight: 600; color: var(--dark); }
    .opini-card-full .author-job { font-size: 0.8rem; color: #888; }
    
    .opini-card-full h5 {
        color: var(--primary);
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .opini-card-full h5 a {
        color: inherit;
        text-decoration: none;
    }
    
    .opini-card-full h5 a:hover { color: var(--accent); }
    
    .opini-card-full .excerpt {
        color: #666;
        font-size: 0.9rem;
        line-height: 1.7;
    }
    
    .opini-card-full .meta {
        font-size: 0.8rem;
        color: #888;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #eee;
    }
</style>
@endpush

@section('content')
    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-comments me-3"></i>Opini Publik</h1>
            <p class="mb-0 opacity-75">Suara dan pandangan dari masyarakat</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row mb-4">
            <div class="col-md-6">
                <p class="text-muted">Menampilkan {{ $opinis->count() }} dari {{ $opinis->total() }} opini</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ route('kirim-opini') }}" class="btn btn-accent">
                    <i class="fas fa-plus me-2"></i>Kirim Opini Anda
                </a>
            </div>
        </div>

        <div class="row g-4">
            @forelse($opinis as $opini)
                <div class="col-md-6">
                    <div class="opini-card-full">
                        <div class="card-body">
                            <div class="author">
                                    <img src="{{ $opini->penulis_foto ? Storage::url($opini->penulis_foto) : ('https://ui-avatars.com/api/?name='.urlencode($opini->penulis_nama).'&background=1e3a5f&color=fff') }}" 
                                        alt="{{ $opini->penulis_nama }}">
                                <div>
                                    <div class="author-name">{{ $opini->penulis_nama }}</div>
                                    <div class="author-job">{{ $opini->penulis_profesi ?? 'Penulis' }}</div>
                                </div>
                            </div>
                            <h5><a href="{{ route('opini.show', $opini->slug) }}">{{ $opini->judul }}</a></h5>
                            <p class="excerpt">{{ Str::limit(strip_tags($opini->konten), 150) }}</p>
                            <div class="meta d-flex justify-content-between">
                                <span><i class="fas fa-calendar me-1"></i>{{ $opini->created_at->format('d M Y') }}</span>
                                <a href="{{ route('opini.show', $opini->slug) }}" class="text-primary">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-comments fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada opini publik</h5>
                        <a href="{{ route('kirim-opini') }}" class="btn btn-primary-custom mt-3">Jadilah yang pertama menulis opini</a>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $opinis->links() }}
        </div>
    </div>
@endsection
