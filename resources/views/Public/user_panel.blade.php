@extends('layouts.legacy_user')

@section('title', 'User Panel')
@section('panel_label', 'User Panel')

@push('styles')
<style>
    .welcome-card {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        border-radius: 12px;
        padding: 30px;
        position: relative;
        overflow: hidden;
    }
    .welcome-card::after {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        width: 150px;
        height: 100%;
        background: rgba(255,255,255,0.1);
        transform: skewX(-20deg) translateX(50px);
    }
    .stat-card-custom {
        transition: transform 0.2s, box-shadow 0.2s;
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        height: 100%;
        background: #fff;
        padding: 20px;
    }
    .stat-card-custom:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    .table-custom th {
        background-color: #f8f9fa;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
</style>
@endpush


@section('content')
    <!-- Welcome Banner -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="welcome-card shadow-sm">
                <div class="d-flex justify-content-between align-items-center position-relative" style="z-index: 2;">
                    <div>
                        <h2 class="fw-bold mb-2">Selamat Datang, {{ explode(' ', $user->name)[0] }}! 👋</h2>
                        <p class="mb-0 opacity-75">Apa yang ingin Anda tulis hari ini?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Profile Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            @if($user->photo)
                                <img src="{{ Storage::url($user->photo) }}" alt="Profile Photo" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 3px solid var(--primary);">
                            @else
                                <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--secondary)); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 32px; font-weight: bold; border: 3px solid var(--primary);">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <h4 class="mb-1 fw-bold">{{ $user->name }}</h4>
                                <p class="mb-0 text-muted">{{ $user->email }}</p>
                                @if($user->nickname)
                                    <p class="mb-0 text-muted small"><i class="fas fa-user-tag me-1"></i>{{ $user->nickname }}</p>
                                @endif
                                @if($user->profesi)
                                    <p class="mb-0 text-muted small"><i class="fas fa-id-badge me-1"></i>{{ $user->profesi }}</p>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('user.profile.edit') }}" class="btn btn-outline-primary">
                            <i class="fas fa-user-edit me-2"></i>Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row g-4">
        <!-- Recent Opini -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; overflow:hidden;">
                <div class="card-header bg-white py-3 px-4 border-bottom">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-newspaper me-2 text-primary"></i>Opini Terakhir</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom table-hover align-middle mb-0">
                        <thead class="table-light">
                          
                        </thead>
                        <tbody>
                            @forelse($opinis->take(5) as $op)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">{{ \Illuminate\Support\Str::limit($op->judul, 40) }}</div>
                                    </td>
                                    <td>
                                        @if($op->status === 'approved')
                                            <span class="badge bg-success rounded-pill">Approved</span>
                                        @elseif($op->status === 'rejected')
                                            <span class="badge bg-danger rounded-pill">Rejected</span>
                                        @else
                                            <span class="badge bg-warning text-dark rounded-pill">Pending</span>
                                        @endif
                                    </td>
                                    <td class="text-muted small">{{ $op->created_at->format('d/m/Y') }}</td>
                                    <td class="text-end pe-4">
                                        @if($op->status === 'approved')
                                            <a href="{{ route('opini.show', $op->slug) }}" class="btn btn-sm btn-light text-primary"><i class="fas fa-eye"></i></a>
                                        @else
                                            <span class="text-muted small"><i class="fas fa-lock"></i> Belum dipublikasikan</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <div class="mb-2"><i class="fas fa-inbox fa-3x opacity-25"></i></div>
                                        Belum ada opini. <a href="{{ route('kirim-opini') }}">Mulai menulis!</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
