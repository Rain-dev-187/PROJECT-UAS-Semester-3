<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'User Panel - PULSA')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --primary: #1e3a5f;
            --secondary: #3d5a80;
            --accent: #ee6c4d;
            --light: #e0fbfc;
            --bg: #f6f8fa;
        }
        *{box-sizing:border-box}
        body{font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background:var(--bg)}
        .sidebar{width:250px;background:#fff;min-height:100vh;border-right:1px solid rgba(0,0,0,0.05);}
        .sidebar .brand{padding:20px;font-weight:800;color:var(--primary);border-bottom:1px solid rgba(0,0,0,0.02)}
        .sidebar .nav-link{color:#333}
        .topbar{background:#fff;border-bottom:1px solid rgba(0,0,0,0.05);padding:12px 20px}
        .content{padding:20px}
        .stat-card{background:#fff;border-radius:12px;padding:18px;box-shadow:0 6px 20px rgba(10,20,30,0.04)}
        .table-card{background:#fff;border-radius:12px;padding:0;box-shadow:0 6px 20px rgba(10,20,30,0.04)}

        /* Banner */
        .bg-gradient-primary{background: linear-gradient(90deg,#12365a 0%, #274f73 60%, #2f5c82 100%); color:#fff; padding:28px; border-radius:10px}
        .banner-title{font-size:28px; font-weight:700; margin-bottom:6px}
        .banner-sub{font-size:14px; color:rgba(255,255,255,0.85)}
        .bg-gradient-primary .text-white-75{ color: #ffffff !important; }

        /* Dashed action card (subtle) */
        .border-dashed{border:1px dashed rgba(11,58,90,0.04); border-radius:12px; background:#fff; box-shadow:none}
        .border-dashed .fw-bold{font-size:16px}

        /* Stat small / labels */
        .stat-small{font-size:0.85rem;color:#6c757d}
        .stat-number{font-size:2.4rem;font-weight:700;color:#0b3a5a}

        /* Approved badge */
        .badge-approve{background:#e6f6ec;color:#1f7a3a;padding:6px 10px;border-radius:12px;font-weight:600}

        /* Buttons and spacing */
        .card .card-body p { color: rgba(0,0,0,0.7); }
        .list-group-item{border:0;padding:18px 20px}
        .list-group-item + .list-group-item{border-top:1px solid rgba(0,0,0,0.04)}

        /* Adjust small badge appearance to match screenshot */
        .badge.bg-warning.text-dark{background:#ffd966;color:#7a5800}
        .badge.bg-success{background:#1f8c3a;color:#ffffff;padding:6px 10px;border-radius:12px;font-weight:600;box-shadow:none}
        .badge-approve{background:#1f8c3a;color:#ffffff;padding:6px 10px;border-radius:12px;font-weight:600}
        .card-header{display:flex;justify-content:space-between;align-items:center;padding:15px;border-bottom:1px solid rgba(0,0,0,0.03)}
        .stat-number{font-size:2.4rem;font-weight:700}
        .list-group-item{border:0;padding:16px 20px}
        .list-group-item .fa-eye{font-size:14px}
        .list-group-item .btn{padding:6px 8px}
        .badge-status{padding:6px 10px;border-radius:8px;font-size:.85rem}
        .btn-primary-custom{background:var(--primary);border-color:var(--primary);color:#fff}
        /* Additional utilities for user panel */
        .stat-card { background:#fff;border-radius:10px; box-shadow:0 1px 2px rgba(0,0,0,0.04); padding:16px }
        .user-account-card {border-radius:10px; background:#fff; padding:16px;}
        .action-eye { background: transparent; border: none; color: #6c757d; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="d-flex">
        <aside class="sidebar">
            <div class="brand">PULSA <small class="d-block text-muted" style="font-weight:400">@yield('panel_label', 'USER PANEL')</small></div>
            <nav class="nav flex-column p-3">
                <a class="nav-link mb-1 {{ request()->is('user/panel') ? 'fw-bold' : '' }}" href="{{ route('user.panel') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                <a class="nav-link mb-1 {{ request()->is('kirim-opini*') ? 'fw-bold' : '' }}" href="{{ route('kirim-opini') }}"><i class="fas fa-pen me-2"></i>Kirim Opini</a>
                <a class="nav-link mb-1" href="{{ route('home') }}"><i class="fas fa-globe me-2"></i>Website</a>
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button class="btn btn-outline-secondary btn-sm w-100" type="submit"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                </form>
            </nav>
        </aside>

        <div class="flex-fill">
            <header class="topbar d-flex justify-content-between align-items-center">
                    <div>
                    <h5 class="mb-0">@yield('title', '')</h5>
                </div>
                <div class="d-flex align-items-center">
                    @if(auth()->user())
                        @include('partials.image-url', ['path' => auth()->user()->photo ?? null])
                        @if(! empty($url))
                            <img src="{{ $url }}" alt="avatar" style="height:36px;width:36px;object-fit:cover;border-radius:6px;margin-right:10px;">
                        @endif
                    @endif
                    <div class="me-3 text-muted small">{{ auth()->user()->email ?? '' }}</div>
                </div>
            </header>

            <main class="content container-fluid">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
