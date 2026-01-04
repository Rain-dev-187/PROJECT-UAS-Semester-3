<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - PULSA')</title>
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
        .stat-card{background:#fff;border-radius:12px;padding:18px;box-shadow:0 6px 20px rgba(0,0,0,0.05)}
        .table-card{background:#fff;border-radius:12px;padding:0;box-shadow:0 6px 20px rgba(0,0,0,0.05)}
        .card-header{display:flex;justify-content:space-between;align-items:center;padding:15px;border-bottom:1px solid rgba(0,0,0,0.03)}
        .stat-number{font-size:1.6rem;font-weight:700}
        .badge-status{padding:6px 10px;border-radius:8px;font-size:.85rem}
        .btn-primary-custom{background:var(--primary);border-color:var(--primary);color:#fff}
    </style>
    @stack('styles')
</head>
<body>
    <div class="d-flex">
        <aside class="sidebar">
            <div class="brand">PULSA <small class="d-block text-muted" style="font-weight:400">@yield('panel_label', 'Admin Panel')</small></div>
            <nav class="nav flex-column p-3">
                @php
                    $isAdminUser = auth()->check() && method_exists(auth()->user(), 'hasAnyRole') && auth()->user()->hasAnyRole(['super-admin','staff']);
                @endphp

                @if($isAdminUser)
                    <a class="nav-link mb-1 {{ request()->is('admin') ? 'fw-bold' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a class="nav-link mb-1 {{ request()->is('admin/berita*') ? 'fw-bold' : '' }}" href="{{ route('admin.berita.index') }}"><i class="fas fa-newspaper me-2"></i>Berita</a>
                    <a class="nav-link mb-1 {{ request()->is('admin/opini*') ? 'fw-bold' : '' }}" href="{{ route('admin.opini.index') }}"><i class="fas fa-comments me-2"></i>Opini</a>
                    <a class="nav-link mb-1 {{ request()->is('admin/suara-pembaca*') ? 'fw-bold' : '' }}" href="{{ route('admin.suara-pembaca.index') }}"><i class="fas fa-bullhorn me-2"></i>Suara Pembaca</a>
                    <a class="nav-link mb-1 {{ request()->is('admin/team*') ? 'fw-bold' : '' }}" href="{{ route('admin.team.index') }}"><i class="fas fa-users me-2"></i>Team</a>
                    @can('manage users')
                        <a class="nav-link mt-3" href="{{ route('admin.users.index') }}"><i class="fas fa-user-cog me-2"></i>Users</a>
                    @endcan
                @else
                    <a class="nav-link mb-1 {{ request()->is('user/panel') ? 'fw-bold' : '' }}" href="{{ route('user.panel') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a class="nav-link mb-1 {{ request()->is('kirim-opini*') ? 'fw-bold' : '' }}" href="{{ route('kirim-opini') }}"><i class="fas fa-pen me-2"></i>Kirim Opini</a>
                    <a class="nav-link mb-1 {{ request()->is('kirim-suara*') ? 'fw-bold' : '' }}" href="{{ route('kirim-suara') }}"><i class="fas fa-bullhorn me-2"></i>Kirim Suara</a>
                    <a class="nav-link mb-1" href="{{ route('home') }}"><i class="fas fa-globe me-2"></i>Website</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button class="btn btn-outline-secondary btn-sm w-100" type="submit"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                </form>
            </nav>
        </aside>

        <div class="flex-fill">
            <header class="topbar d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">@yield('title', 'Dashboard')</h5>
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
