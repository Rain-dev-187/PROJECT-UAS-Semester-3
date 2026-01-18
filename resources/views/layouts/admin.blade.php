<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - PULSA')</title>
    <!-- Font Awesome, Bootstrap 4 and AdminLTE v3 Stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
    <style>
        :root {
            --primary: #1e3a5f;
            --secondary: #3d5a80;
            --accent: #ee6c4d;
            --light: #e0fbfc;
            --bg: #f6f8fa;
        }
        .main-sidebar {
            background-color: var(--primary) !important;
        }
        /* Brand logo behavior: show logo+text when expanded, logo only when collapsed */
        .brand-image{height:32px;width:32px;object-fit:cover;margin-right:8px;display:inline-block}
        body.sidebar-collapse .brand-text{display:none}
        /* Compatibility helpers for existing admin cards/tables */
        .stat-card{background:#fff;border-radius:8px;padding:16px;box-shadow:0 6px 18px rgba(0,0,0,0.04)}
        .table-card{background:#fff;border-radius:8px;padding:0;box-shadow:0 6px 18px rgba(0,0,0,0.04)}
        .card-header{display:flex;justify-content:space-between;align-items:center;padding:12px;border-bottom:1px solid rgba(0,0,0,0.03)}
        .stat-number{font-size:1.5rem;font-weight:700}
        .badge-status{padding:6px 10px;border-radius:8px;font-size:.85rem}
    </style>
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                @if(auth()->user())
                    @include('partials.image-url', ['path' => auth()->user()->photo ?? null])
                    @if(! empty($url))
                        <li class="nav-item d-flex align-items-center">
                            <img src="{{ $url }}" alt="avatar" class="rounded-circle" style="height:34px;width:34px;object-fit:cover;margin-right:8px;">
                        </li>
                    @endif
                    <li class="nav-item d-flex align-items-center">
                        <div class="d-flex flex-column">
                            <span class="text-muted small">{{ auth()->user()->email ?? '' }}</span>
                        </div>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-sm btn-outline-secondary ml-3" type="submit"><i class="fas fa-sign-out-alt"></i></button>
                        </form>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
                <img src="{{ asset('images/pulsa-logo.png') }}" alt="PULSA Logo" class="brand-image img-circle elevation-2">
                <span class="brand-text font-weight-light">PULSA Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        @php
                            $isAdminUser = auth()->check() && method_exists(auth()->user(), 'hasAnyRole') && auth()->user()->hasAnyRole(['super-admin','Admin']);
                        @endphp

                        @if($isAdminUser)
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.berita.index') }}" class="nav-link {{ request()->is('admin/berita*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-newspaper"></i>
                                    <p>Berita</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.opini.index') }}" class="nav-link {{ request()->is('admin/opini*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-comments"></i>
                                    <p>Opini</p>
                                </a>
                            </li>
                            <!-- Suara Pembaca removed -->
                            <li class="nav-item">
                                <a href="{{ route('admin.team.index') }}" class="nav-link {{ request()->is('admin/team*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Team</p>
                                </a>
                            </li>
                            @can('manage users')
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-user-cog"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                            @endcan
                        @else
                            <li class="nav-item">
                                <a href="{{ route('user.panel') }}" class="nav-link {{ request()->is('user/panel') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('kirim-opini') }}" class="nav-link {{ request()->is('kirim-opini*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-pen"></i>
                                    <p>Kirim Opini</p>
                                </a>
                            </li>
                            <!-- Kirim Suara removed -->
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link">
                                    <i class="nav-icon fas fa-globe"></i>
                                    <p>Website</p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item mt-3">
                            <a href="#" class="nav-link text-start" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title', 'Dashboard')</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @yield('content')
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
            </div>
            <strong>Copyright &copy; {{ date('Y') }} <a href="#">PULSA</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery, Bootstrap 4 and AdminLTE v3 Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
    @stack('scripts')
</body>
</html>
