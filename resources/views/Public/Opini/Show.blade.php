@extends('layouts.public')

@section('title', $opini->judul . ' - PULSA')

@push('styles')
<style>
    .opini-header {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        padding: 60px 0;
        color: #fff;
    }
    
    .author-box {
        display: flex;
        align-items: center;
        background: rgba(255,255,255,0.1);
        padding: 20px;
        border-radius: 15px;
        margin-bottom: 20px;
    }
    
    .author-box img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 20px;
        border: 4px solid #fff;
    }
    
    .author-box .name {
        font-weight: 700;
        font-size: 1.2rem;
    }
    
    .author-box .job {
        opacity: 0.8;
    }
    
    .opini-content {
        background: #fff;
        border-radius: 15px;
        padding: 40px;
        margin-top: -30px;
        box-shadow: 0 5px 30px rgba(0,0,0,0.1);
    }
    
    .opini-content .content {
        font-size: 1.1rem;
        line-height: 1.9;
        color: #444;
        /* Prevent long lines from stretching layout */
        overflow-wrap: break-word;
        word-break: break-word;
        white-space: pre-line;
    }
    
    .opini-content .content p { margin-bottom: 20px; }
    
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
    .share-buttons .x-twitter { background: #000; }
    .share-buttons .whatsapp { background: #25d366; }
</style>
@endpush

@section('content')
    <div class="opini-header">
        <div class="container">
             <div class="author-box">
             <img src="{{ $opini->penulis_foto ? Storage::url($opini->penulis_foto) : 'https://ui-avatars.com/api/?name='.urlencode($opini->penulis_nama).'&background=fff&color=1e3a5f&size=80' }}" 
                 alt="{{ $opini->penulis_nama }}">
                <div>
                    <div class="name">{{ $opini->penulis_nama }}</div>
                    <div class="job">{{ $opini->penulis_profesi ?? 'Penulis' }}</div>
                </div>
            </div>
            <h1>{{ $opini->judul }}</h1>
            <div class="mt-3 opacity-75">
                <i class="fas fa-calendar me-2"></i>{{ $opini->created_at->format('d F Y') }}
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="opini-content">
                    <div class="content">
                        {!! nl2br(e($opini->konten)) !!}
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Bagikan:</strong>
                            <div class="share-buttons d-inline ms-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $opini->judul }}" target="_blank" class="x-twitter"><i class="fab fa-x-twitter"></i></a>
                                <a href="https://wa.me/?text={{ $opini->judul }} {{ url()->current() }}" target="_blank" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                        <a href="{{ route('opini.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
