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
    .quick-action-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 20px;
        border-radius: 12px;
        border: 2px dashed #e0e0e0;
        color: #555;
        text-decoration: none;
        transition: all 0.2s;
        height: 100%;
    }
    .quick-action-btn:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: rgba(30, 58, 95, 0.05);
    }
    .quick-action-btn i {
        font-size: 24px;
        margin-bottom: 10px;
    }
    .table-custom th {
        background-color: #f8f9fa;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    .table-custom tbody tr.clickable-row{cursor:pointer}
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

    <!-- Quick Actions & Stats -->
    <div class="row g-4 mb-4">
        <!-- Account (beside Total Opini) -->
        <div class="col-md-6 col-lg-3">
            <div class="stat-card-custom d-flex gap-3 align-items-center">
                <div style="width:64px">
                    @if(! empty($user->photo))
                        <img src="{{ Storage::url($user->photo) }}" alt="avatar" style="width:64px;height:64px;object-fit:cover;border-radius:8px">
                    @else
                        <i class="fas fa-user-circle fa-3x text-muted"></i>
                    @endif
                </div>
                <div class="flex-fill">
                    <div class="fw-bold">{{ $user->name }}</div>
                    <div class="small text-muted">{{ $user->email }}</div>
                    @if(! empty($user->nickname))
                        <div class="small text-muted">Nickname: {{ $user->nickname }}</div>
                    @endif
                    <div class="mt-2">
                        @if(\Illuminate\Support\Facades\Route::has('user.profile.edit'))
                            <a href="{{ route('user.profile.edit') }}" class="btn btn-sm btn-outline-secondary">Edit Profile</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Suara Pembaca removed -->

        <!-- Action: Kirim Opini -->
        <div class="col-6 col-lg-3">
            <a href="{{ route('kirim-opini') }}" class="quick-action-btn">
                <i class="fas fa-pen text-primary"></i>
                <span class="fw-bold">Kirim Opini Baru</span>
            </a>
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
                                @php
                                    if($op->status === 'approved' && ! empty($op->slug) && \Illuminate\Support\Facades\Route::has('opini.show')) {
                                        $link = route('opini.show', $op->slug);
                                    } elseif(\Illuminate\Support\Facades\Route::has('opini.showById')) {
                                        $link = route('opini.showById', $op->id);
                                    } else {
                                        $link = '#';
                                    }
                                @endphp
                                <tr class="clickable-row" onclick="if('{{ $link }}' !== '#') window.location='{{ $link }}'">
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
                                         @if($op->status === 'approved' && ! empty($op->slug))
                                            <a href="{{ route('opini.show', $op->slug) }}" class="btn btn-sm btn-light text-primary"><i class="fas fa-eye"></i></a>
                                        @else
                                            <a href="{{ route('opini.showById', $op->id) }}" class="btn btn-sm btn-light text-secondary"><i class="fas fa-eye"></i></a>
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