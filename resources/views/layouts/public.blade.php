<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PULSA - Media Digital Aspirasi & Jurnalisme Warga')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --primary: #1e3a5f;
            --secondary: #3d5a80;
            --accent: #ee6c4d;
            --light: #e0fbfc;
            --dark: #293241;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f6f8fa;
        }
        
        .navbar-custom {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-custom .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            color: #fff !important;
        }
        
        .navbar-custom .navbar-brand span {
            font-size: 0.7rem;
            display: block;
            font-weight: 400;
            opacity: 0.8;
        }
        
        .navbar-custom .nav-link {
            color: rgba(255,255,255,0.9) !important;
            margin: 0 10px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: var(--accent) !important;
        }
        
        .btn-login {
            background-color: var(--accent);
            color: #fff !important;
            border: none;
            padding: 8px 25px;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background-color: #d45a3d;
            transform: translateY(-2px);
        }
        
        .btn-primary-custom {
            background-color: var(--primary);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            color: #fff;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-primary-custom:hover {
            background-color: var(--secondary);
            color: #fff;
            transform: translateY(-2px);
        }
        
        .btn-accent {
            background-color: var(--accent);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            color: #fff;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-accent:hover {
            background-color: #d45a3d;
            color: #fff;
            transform: translateY(-2px);
        }
        
        .section-title {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--accent);
            border-radius: 2px;
        }
        
        .section-title.text-center::after {
            left: 50%;
            transform: translateX(-50%);
        }
        
        .card-custom {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            border: none;
            overflow: hidden;
            transition: all 0.3s;
        }
        
        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        }
        
        .footer {
            background: linear-gradient(135deg, var(--primary), var(--dark));
            color: #fff;
            padding: 40px 0 20px;
            margin-top: 60px;
        }
        
        .footer h5 { font-weight: 700; margin-bottom: 5px; }
        
        .footer a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer a:hover { color: var(--accent); }
        
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 20px;
            margin-top: 30px;
        }
        
        .alert-custom {
            border-radius: 10px;
            border: none;
        }

        /* Make the landing page 'Tentang Kami' section match the navbar gradient */
        .team-section {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            padding: 60px 0;
        }

        .team-section .section-title {
            color: #fff;
        }

        .team-section .team-card {
            background: rgba(255,255,255,0.04);
            border-radius: 10px;
            padding: 12px;
            text-align: center;
            color: #fff;
        }

        .team-section .team-card img {
            border-radius: 50%;
            width: 100%;
            max-width: 120px;
            height: auto;
            margin-bottom: 10px;
            border: 3px solid rgba(255,255,255,0.08);
        }

        /* Global responsive helpers to avoid layout break on zoom */
        img, .card img, .team-card img, .opini-card img, .opini-card-full .author img, .reader-info img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        /* Ensure container stays centered and adapts to zoom */
        .container, .container-fluid {
            width: 100%;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 15px;
            padding-right: 15px;
        }

        /* Prevent fixed pixel widths on small components */
        .team-card, .card-custom, .opini-card-full, .table-card {
            width: auto;
            max-width: 100%;
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                PULSA
                <span>Publik Suara Aspirasi</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars text-white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('berita.*') ? 'active' : '' }}" href="{{ route('berita.index') }}">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('opini.*') ? 'active' : '' }}" href="{{ route('opini.index') }}">Opini Publik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}" href="{{ route('tentang') }}">Tentang Kami</a>
                    </li>
                </ul>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-login">
                        <i class="fas fa-user me-1"></i> Dashboard
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline ms-2">
                        @csrf
                        <button type="submit" class="btn btn-login">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('register') }}" class="btn btn-login me-2">
                        <i class="fas fa-user-plus me-1"></i> Daftar
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-login">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-custom alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container mt-3">
            <div class="alert alert-danger alert-custom alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @yield('content')

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5>PULSA</h5>
                    <p class="text-white-50">Publik Suara Aspirasi</p>
                    <p class="text-white-50 small">Media Digital Aspirasi & Jurnalisme Warga yang menjadi wadah partisipasi masyarakat.</p>
                </div>
                <div class="col-lg-4 mb-4">
                    <h6 class="text-white mb-3">Menu</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}"><i class="fas fa-chevron-right me-2 small"></i>Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('berita.index') }}"><i class="fas fa-chevron-right me-2 small"></i>Berita</a></li>
                        <li class="mb-2"><a href="{{ route('opini.index') }}"><i class="fas fa-chevron-right me-2 small"></i>Opini Publik</a></li>
                        <li class="mb-2"><a href="{{ route('tentang') }}"><i class="fas fa-chevron-right me-2 small"></i>Tentang Kami</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h6 class="text-white mb-3"><a href="{{ route('tentang') }}" class="text-white text-decoration-none">Hubungi Kami</a></h6>
                    <ul class="list-unstyled text-white-50">
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i> <a href="mailto:Pulsacs187@gmail.com" class="text-white-50">Pulsacs187@gmail.com</a></li>
                        <li class="mb-2"><i class="fab fa-whatsapp me-2"></i> <a href="https://wa.me/6288220588345" target="_blank" rel="noopener" class="text-white-50">088220588345</a></li>
                        <li class="mb-2"><i class="fab fa-instagram me-2"></i> <a href="https://instagram.com/pulsa.id" target="_blank" rel="noopener" class="text-white-50">@pulsa.id</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom text-center">
                <small class="text-white-50">&copy; {{ date('Y') }} PULSA - Kelompok 4</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
