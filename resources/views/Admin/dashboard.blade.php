@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Welcome -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="stat-card" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: #fff;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1">Selamat Datang, {{ auth()->user()->name }}! 👋</h4>
                        <p class="mb-0 opacity-75">Kelola konten website PULSA dari dashboard ini.</p>
                    </div>
                    <div class="d-none d-md-block">
                        <i class="fas fa-chart-line fa-3x opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Detail Card -->
    <div class="row g-4 mb-4">
        <div class="col-lg-4">
            <div class="table-card">
                <div class="card-header">
                    <h5><i class="fas fa-user me-2 text-primary"></i>Akun Saya</h5>
                    @if(Route::has('user.profile.edit'))
                        <a href="{{ route('user.profile.edit') }}" class="btn btn-sm btn-outline-primary">Edit Profile</a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="d-flex gap-3 align-items-center mb-3">
                        @if(auth()->user()->photo)
                            <img src="{{ Storage::url(auth()->user()->photo) }}" style="height:80px;width:80px;object-fit:cover;border-radius:8px">
                        @else
                            <i class="fas fa-user-circle fa-3x text-muted"></i>
                        @endif
                        <div>
                            <div class="fw-bold">{{ auth()->user()->name }}</div>
                            <div class="text-muted small">{{ auth()->user()->email }}</div>
                            @if(auth()->user()->nickname)
                                <div class="text-muted small">Nickname: {{ auth()->user()->nickname }}</div>
                            @endif
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">Lihat Website</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <a href="{{ route('admin.berita.index') }}" style="text-decoration:none;color:inherit;display:block">
                <div class="stat-card">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="stat-number">{{ $stats['total_berita'] }}</div>
                            <div class="stat-label">Total Berita</div>
                        </div>
                        <div class="stat-icon primary">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-success"><i class="fas fa-check-circle me-1"></i>{{ $stats['berita_published'] }} Published</small>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-sm-6 col-xl-3">
            <a href="{{ route('admin.opini.index') }}" style="text-decoration:none;color:inherit;display:block">
                <div class="stat-card">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="stat-number">{{ $stats['total_opini'] }}</div>
                            <div class="stat-label">Total Opini</div>
                        </div>
                        <div class="stat-icon success">
                            <i class="fas fa-comments"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        @if($stats['opini_pending'] > 0)
                            <small class="text-warning"><i class="fas fa-clock me-1"></i>{{ $stats['opini_pending'] }} Menunggu Review</small>
                        @else
                            <small class="text-success"><i class="fas fa-check-circle me-1"></i>Semua sudah direview</small>
                        @endif
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-sm-6 col-xl-3">
            <a href="{{ route('admin.suara-pembaca.index') }}" style="text-decoration:none;color:inherit;display:block">
                <div class="stat-card">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="stat-number">{{ $stats['total_suara'] }}</div>
                            <div class="stat-label">Suara Pembaca</div>
                        </div>
                        <div class="stat-icon warning">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        @if($stats['suara_pending'] > 0)
                            <small class="text-warning"><i class="fas fa-clock me-1"></i>{{ $stats['suara_pending'] }} Menunggu Review</small>
                        @else
                            <small class="text-success"><i class="fas fa-check-circle me-1"></i>Semua sudah direview</small>
                        @endif
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-sm-6 col-xl-3">
            @can('manage users')
                <a href="{{ route('admin.users.index') }}" style="text-decoration:none;color:inherit;display:block">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="stat-number">{{ $stats['total_users'] }}</div>
                                <div class="stat-label">Total Users</div>
                            </div>
                            <div class="stat-icon danger">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <small class="text-muted"><i class="fas fa-user-shield me-1"></i>{{ auth()->user()->roles->first()->name ?? 'User' }}</small>
                        </div>
                    </div>
                </a>
            @else
                <div class="stat-card">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="stat-number">{{ $stats['total_users'] }}</div>
                            <div class="stat-label">Total Users</div>
                        </div>
                        <div class="stat-icon danger">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted"><i class="fas fa-user-shield me-1"></i>{{ auth()->user()->roles->first()->name ?? 'User' }}</small>
                    </div>
                </div>
            @endcan
        </div>
    </div>

    <!-- Tables -->
    <div class="row g-4">
        <!-- Latest Berita -->
        <div class="col-lg-6">
            <div class="table-card">
                <div class="card-header">
                    <h5><i class="fas fa-newspaper me-2 text-primary"></i>Berita Terbaru</h5>
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestBerita as $berita)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.berita.edit', $berita) }}" class="text-dark text-decoration-none fw-medium">
                                            {{ Str::limit($berita->judul, 30) }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge-status badge-{{ $berita->status }}">
                                            {{ ucfirst($berita->status) }}
                                        </span>
                                    </td>
                                    <td class="text-muted small">{{ $berita->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Belum ada berita</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Latest Opini -->
        <div class="col-lg-6">
            <div class="table-card">
                <div class="card-header">
                    <h5><i class="fas fa-comments me-2 text-success"></i>Opini Terbaru</h5>
                    <a href="{{ route('admin.opini.index') }}" class="btn btn-sm btn-outline-success">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestOpini as $opini)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.opini.edit', $opini) }}" class="text-dark text-decoration-none fw-medium">
                                            {{ Str::limit($opini->judul, 30) }}
                                        </a>
                                        <br>
                                        <small class="text-muted">oleh {{ $opini->penulis_nama }}</small>
                                    </td>
                                    <td>
                                        <span class="badge-status badge-{{ $opini->status }}">
                                            {{ ucfirst($opini->status) }}
                                        </span>
                                    </td>
                                    <td class="text-muted small">{{ $opini->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Belum ada opini</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="stat-card">
                <h6 class="mb-3"><i class="fas fa-bolt me-2 text-warning"></i>Aksi Cepat</h6>
                <div class="d-flex flex-wrap gap-2">
                    @can('manage berita')
                        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary-custom">
                            <i class="fas fa-plus me-2"></i>Tambah Berita
                        </a>
                    @endcan
                    @can('manage opini')
                        <a href="{{ route('admin.opini.create') }}" class="btn btn-outline-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Opini
                        </a>
                    @endcan
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>Lihat Website
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
