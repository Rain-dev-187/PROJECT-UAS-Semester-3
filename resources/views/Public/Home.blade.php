@extends('layouts.public')

@section('title', 'PULSA - Media Digital Aspirasi & Jurnalisme Warga')

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, var(--light) 0%, #fff 100%);
        padding: 80px 0;
        min-height: 500px;
    }
    
    .hero-section h1 {
        color: var(--primary);
        font-weight: 800;
        font-size: 2.5rem;
        margin-bottom: 20px;
        line-height: 1.3;
    }
    
    .hero-section p {
        color: #555;
        font-size: 1rem;
        line-height: 1.8;
    }
    
    .feature-card {
        background: #fff;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        border-left: 4px solid var(--accent);
        transition: all 0.3s;
        height: 100%;
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    }
    
    .feature-card h5 {
        color: var(--primary);
        font-weight: 700;
    }
    
    .feature-card p {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 0;
    }
    
    .feature-card .icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin-bottom: 15px;
    }
    
    .opini-card {
        display: flex;
        align-items: flex-start;
        padding: 20px;
        background: #fff;
        border-radius: 12px;
        margin-bottom: 15px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.05);
        transition: all 0.3s;
        text-decoration: none;
    }
    
    .opini-card:hover {
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        transform: translateX(5px);
    }
    
    .opini-card img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 15px;
        border: 3px solid var(--light);
    }

    /* Ensure opini card text wraps and doesn't cause horizontal scroll */
    .opini-card h6, .opini-card small {
        overflow-wrap: break-word;
        word-break: break-word;
    }
    
    .opini-card h6 {
        color: var(--primary);
        font-weight: 600;
        margin-bottom: 5px;
        font-size: 0.95rem;
    }
    
    .opini-card small {
        color: #888;
        font-size: 0.8rem;
    }
    
    .speech-bubble {
        position: relative;
        background: #fff;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        border: 2px solid var(--light);
    }

    /* Prevent very long messages from breaking layout */
    .speech-bubble p {
        overflow-wrap: break-word;
        word-break: break-word;
        white-space: pre-line;
    }
    
    .speech-bubble::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 30px;
        border-width: 12px 12px 0;
        border-style: solid;
        border-color: #fff transparent transparent;
    }
    
    .speech-bubble p {
        color: #555;
        font-style: italic;
        margin-bottom: 10px;
        font-size: 0.95rem;
    }
    
    .speech-bubble .author {
        color: var(--accent);
        font-weight: 600;
        font-size: 0.85rem;
    }
    
    .reader-info {
        display: flex;
        align-items: center;
        margin-top: 15px;
        margin-left: 20px;
    }
    
    .reader-info img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--accent);
        margin-right: 10px;
    }
    
    .team-section {
        background: linear-gradient(135deg, var(--light) 0%, #fff 100%);
        padding: 60px 0;
    }
    
    .team-card {
        text-align: center;
        padding: 20px;
        transition: all 0.3s;
    }
    
    .team-card img {
        width: 120px;
        height: 120px;
        border-radius: 15px;
        object-fit: cover;
        margin-bottom: 15px;
        border: 4px solid #fff;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        transition: all 0.3s;
    }
    
    .team-card:hover img {
        transform: scale(1.05);
        border-color: var(--accent);
    }
    
    .team-card h6 {
        color: var(--accent);
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .team-card small {
        color: var(--secondary);
        font-size: 0.8rem;
    }
    
    .contact-box {
        background: #fff;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        border-top: 4px solid var(--accent);
    }
    
    .contact-box i {
        color: var(--accent);
        width: 25px;
    }
    
    .section-padding {
        padding: 60px 0;
    }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <h1>Media Digital Aspirasi &<br>Jurnalisme Warga</h1>
                    <p class="mb-4">
                        Publik Suara Aspirasi (PULSA) merupakan sebuah website yang berperan sebagai media 
                        digital aspirasi dan jurnalisme warga. Website ini menjadi sarana partisipasi masyarakat 
                        dalam menyampaikan pendapat, gagasan, serta isu-isu publik secara terbuka dan 
                        bertanggung jawab.
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('berita.index') }}" class="btn btn-primary-custom">
                            <i class="fas fa-newspaper me-2"></i>Baca Berita Terbaru
                        </a>
                        <a href="{{ route('kirim-opini') }}" class="btn btn-accent">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Opini
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 text-center">
                    @php
                        $logoPath = file_exists(public_path('images/pulsa-logo.png')) ? asset('images/pulsa-logo.png') : asset('images/pulsa-logo.svg');
                    @endphp
                    <img src="{{ $logoPath }}" alt="PULSA Logo" class="img-fluid rounded-4 shadow-lg" style="max-height:300px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Utama -->
    <section class="section-padding">
        <div class="container">
            <h3 class="section-title">Fitur Utama</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <a href="{{ route('opini.index') }}" class="feature-link">
                        <div class="feature-card">
                            <div class="icon"><i class="fas fa-comments"></i></div>
                            <h5>Opini Publik</h5>
                            <p>Wadah bagi masyarakat untuk menyampaikan pendapat dan pandangan terhadap isu-isu publik.</p>
                        </div>
                    </a>
                </div>
                <!-- Suara Pembaca feature removed -->
                <div class="col-md-4">
                    <a href="{{ route('tentang') }}" class="feature-link">
                        <div class="feature-card">
                            <div class="icon"><i class="fas fa-info-circle"></i></div>
                            <h5>Tentang Kami</h5>
                            <p>Informasi mengenai profil, tujuan, dan peran PULSA sebagai media digital aspirasi.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

@push('styles')
<style>
    .feature-link { text-decoration:none; color:inherit; display:block; height:100%; }
    .feature-link .feature-card { height:100%; }
</style>
@endpush

    <!-- Opini Publik -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="row">
                <!-- Opini Publik -->
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h3 class="section-title">Opini Publik</h3>
                    
                    @if($opinis->isNotEmpty())
                        @if($opinis->count() > 1)
                            <div id="opiniCarouselHome" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                                <div class="carousel-inner">
                                    @foreach($opinis as $i => $opini)
                                        <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                            <a href="{{ route('opini.show', $opini->slug) }}" class="opini-card d-block">
                                                <img src="{{ $opini->penulis_foto ? Storage::url($opini->penulis_foto) : ('https://ui-avatars.com/api/?name='.urlencode($opini->penulis_nama).'&background=1e3a5f&color=fff') }}" alt="{{ $opini->penulis_nama }}">
                                                <div>
                                                    <h6>{{ Str::limit($opini->judul, 80) }}</h6>
                                                    <small><i class="fas fa-user me-1"></i>Ditulis oleh: {{ $opini->penulis_nama }}</small>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#opiniCarouselHome" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#opiniCarouselHome" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @else
                            @php $opini = $opinis->first(); @endphp
                            <a href="{{ route('opini.show', $opini->slug) }}" class="opini-card">
                                <img src="{{ $opini->penulis_foto ? Storage::url($opini->penulis_foto) : ('https://ui-avatars.com/api/?name='.urlencode($opini->penulis_nama).'&background=1e3a5f&color=fff') }}" alt="{{ $opini->penulis_nama }}">
                                <div>
                                    <h6>{{ Str::limit($opini->judul, 80) }}</h6>
                                    <small><i class="fas fa-user me-1"></i>Ditulis oleh: {{ $opini->penulis_nama }}</small>
                                </div>
                            </a>
                        @endif
                    @else
                        <p class="text-muted">Belum ada opini publik.</p>
                    @endif
                    
                    <a href="{{ route('opini.index') }}" class="btn btn-outline-primary mt-3">
                        Lihat Semua Opini <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
                
                <!-- Suara Pembaca section removed -->
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section" id="tentang">
        <div class="container">
            <h3 class="section-title">Tentang Kami</h3>
            <p class="mb-5 text-muted" style="max-width: 800px;">
                Publik Suara Aspirasi (PULSA) merupakan media digital aspirasi dan jurnalisme warga yang dikembangkan sebagai wadah 
                partisipasi publik dalam menyampaikan pendapat dan gagasan.
            </p>
            
            <div class="row g-4 justify-content-center">
                @foreach($teams as $team)
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="team-card">
                            <img src="{{ $team->foto ? asset('storage/'.$team->foto) : ('https://ui-avatars.com/api/?name='.urlencode($team->nama).'&background=1e3a5f&color=fff&size=120') }}" 
                                 alt="{{ $team->nama }}">
                            <h6>{{ $team->nama }}</h6>
                            <small>{{ $team->npm ?? 'NPM' }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section-padding">
        <div class="container">
            <h3 class="section-title">Hubungi Kami</h3>
            <div class="row">
                <div class="col-lg-8">
                    <div class="contact-box">
                        <p class="mb-4">
                            Apabila pengguna mengalami kendala atau membutuhkan informasi lebih lanjut terkait website 
                            Publik Suara Aspirasi (PULSA), silakan menghubungi tim pengelola melalui kontak yang tersedia.
                        </p>
                        <p class="mb-2"><i class="fas fa-envelope me-2"></i> Email: <a href="https://mail.google.com/mail/?view=cm&fs=1&to=Pulsacs187@gmail.com" target="_blank" rel="noopener">Pulsacs187@gmail.com</a></p>
                        <p class="mb-2"><i class="fab fa-whatsapp me-2"></i> WhatsApp: <a href="https://wa.me/6288220588345" target="_blank" rel="noopener">088220588345</a></p>
                        <p class="mb-0"><i class="fab fa-instagram me-2"></i> Instagram: <a href="https://instagram.com/pulsa.id" target="_blank" rel="noopener">@pulsa.id</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
