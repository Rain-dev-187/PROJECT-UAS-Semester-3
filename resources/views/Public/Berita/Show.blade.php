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
    .share-buttons .x-twitter { background: #000; }
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

    .comments-section {
        margin-top: 40px;
        padding-top: 40px;
        border-top: 2px solid #eee;
    }

    .comment-item {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .comment-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 10px;
    }

    .comment-author {
        font-weight: 600;
        color: var(--dark);
    }

    .comment-date {
        font-size: 0.85rem;
        color: #999;
    }

    .comment-content {
        color: #555;
        line-height: 1.6;
        white-space: pre-line;
    }

    .comment-form-section {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .comment-form-section h5 {
        margin-bottom: 20px;
        color: var(--dark);
    }

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
                                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $berita->judul }}" target="_blank" class="x-twitter"><i class="fab fa-x-twitter"></i></a>
                                <a href="https://wa.me/?text={{ $berita->judul }} {{ url()->current() }}" target="_blank" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                        <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>

                    <!-- Comments Section -->
                    <div class="comments-section">
                        <h4 class="mb-4"><i class="fas fa-comments me-2 text-primary"></i>Komentar ({{ $berita->comments()->approved()->count() }})</h4>

                        <!-- Comments Form -->
                        <div class="comment-form-section">
                            @if($errors->any())
                                <div class="alert alert-danger mb-3">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(session('success'))
                                <div class="alert alert-success mb-3">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <h5><i class="fas fa-pencil-alt me-2"></i>Tambah Komentar</h5>
                            <form action="{{ route('berita.comments.store', $berita->slug) }}" method="POST">
                                @csrf
                                @if(!auth()->check())
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Nama <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label class="form-label">Komentar <span class="text-danger">*</span></label>
                                    <textarea name="content" rows="5" class="form-control @error('content') is-invalid @enderror" placeholder="Tulis komentar Anda di sini..." required>{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary-custom">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Komentar
                                </button>
                            </form>
                        </div>

                        <!-- Comments List -->
                        @forelse($berita->comments()->approved()->latest()->get() as $comment)
                            <div class="comment-item">
                                <div class="comment-header">
                                    <div>
                                        <div class="comment-author">{{ $comment->name ?? $comment->user?->name }}</div>
                                        <div class="comment-date">{{ $comment->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    {{ $comment->content }}
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>Belum ada komentar. Jadilah yang pertama berkomentar!
                            </div>
                        @endforelse
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
