@extends('layouts.public')

@section('title', 'Tentang Kami - PULSA')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        padding: 60px 0;
        color: #fff;
        margin-bottom: 40px;
    }
    
    .about-card {
        background: #fff;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 5px 30px rgba(0,0,0,0.08);
        margin-bottom: 40px;
    }
    
    .about-card h4 {
        color: var(--primary);
        font-weight: 700;
        margin-bottom: 20px;
    }
    
    .about-card p {
        color: #000;
        line-height: 1.8;
    }
    
    .team-card {
        text-align: center;
        padding: 25px;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .team-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    }
    
    .img-wrapper {
        width: 120px;
        height: 120px;
        border-radius: 10px;
        overflow: hidden;
        margin: 0 auto 15px;
        border: 4px solid var(--light);
    }

    .img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.3s;
    }
    
    .team-card:hover img {
        border-color: var(--accent);
    }
    
    .team-card h6 {
        color: var(--primary);
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .team-card .npm {
        color: var(--accent);
        font-size: 0.85rem;
        font-weight: 500;
    }
    
    .contact-card {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 15px;
        padding: 40px;
        color: #fff;
    }
    
    .contact-card h4 { font-weight: 700; margin-bottom: 20px; }
    
    .contact-card .contact-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .contact-card .contact-item i {
        width: 40px;
        height: 40px;
        background: rgba(255,255,255,0.2);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }
</style>
@endpush

@section('content')
    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-users me-3"></i>Tentang Kami</h1>
            <p class="mb-0 opacity-75">Mengenal lebih dekat tim di balik PULSA</p>
        </div>
    </div>

    <div class="container mb-5">
        <!-- About Section -->
        <div class="about-card">
            <h4><i class="fas fa-info-circle me-2 text-accent"></i>Tentang PULSA</h4>
            <p>
                Publik Suara Aspirasi (PULSA) merupakan media digital aspirasi dan jurnalisme warga yang dikembangkan 
                sebagai wadah partisipasi publik dalam menyampaikan pendapat dan gagasan. Website ini dibuat oleh tim 
                pengelola PULSA dengan tujuan mendorong keterbukaan, dialog konstruktif, dan penyampaian aspirasi 
                secara bertanggung jawab.
            </p>
            <p>
                Untuk keperluan komunikasi, saran, atau kerja sama, pengguna dapat menghubungi pengelola melalui 
                halaman kontak yang tersedia di website.
            </p>
            
            <div class="row mt-4">
                <div class="col-md-4 mb-3">
                    <div class="d-flex align-items-center">
                        <div class="icon-box me-3" style="width:50px;height:50px;background:var(--light);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-bullseye text-primary"></i>
                        </div>
                        <div>
                            <strong>Visi</strong>
                            <p class="mb-0 small text-muted">Menjadi wadah aspirasi publik terpercaya</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="d-flex align-items-center">
                        <div class="icon-box me-3" style="width:50px;height:50px;background:var(--light);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-rocket text-primary"></i>
                        </div>
                        <div>
                            <strong>Misi</strong>
                            <p class="mb-0 small text-muted">Mendorong partisipasi aktif masyarakat</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="d-flex align-items-center">
                        <div class="icon-box me-3" style="width:50px;height:50px;background:var(--light);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-heart text-primary"></i>
                        </div>
                        <div>
                            <strong>Nilai</strong>
                            <p class="mb-0 small text-muted">Transparansi, Integritas, Inklusif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Section -->
        <h4 class="section-title mb-4">Tim Kelompok 4</h4>
        <div class="row g-4 mb-5">
            @foreach($teams as $team)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="team-card">
                        <div class="img-wrapper">
                            <img src="{{ $team->foto ? asset('storage/'.$team->foto) : 'https://ui-avatars.com/api/?name='.urlencode($team->nama).'&background=1e3a5f&color=fff&size=120' }}" 
                                alt="{{ $team->nama }}">
                        </div>
                        <h6>{{ $team->nama }}</h6>
                        <div class="npm">{{ $team->npm }}</div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Contact Section -->
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-card">
                    <h4><i class="fas fa-envelope me-2"></i>Hubungi Kami</h4>
                    <p class="opacity-75 mb-4">
                        Apabila pengguna mengalami kendala atau membutuhkan informasi lebih lanjut terkait website 
                        Publik Suara Aspirasi (PULSA), silakan menghubungi tim pengelola melalui kontak yang tersedia.
                    </p>
                    
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span><a href="https://mail.google.com/mail/?view=cm&fs=1&to=pulsacs187@gmail.com" target="_blank" rel="noopener">Pulsacs187@gmail.com</a></span>
                    </div>
                    <div class="contact-item">
                        <i class="fab fa-whatsapp"></i>
                        <span><a href="https://wa.me/6288220588345" target="_blank" rel="noopener">088220588345</a></span>
                    </div>
                    <div class="contact-item">
                        <i class="fab fa-instagram"></i>
                        <span><a href="https://instagram.com/pulsa.id" target="_blank" rel="noopener">@pulsa.id</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
