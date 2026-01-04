@extends('layouts.legacy_user')

@section('title', 'User Panel')
@section('panel_label', 'User Panel')

@section('content')
    <div class="row g-4 mb-4">
        <!-- Left: Account -->
        <div class="col-lg-4">
            <div class="table-card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-user me-2 text-primary"></i>Akun Saya</h5>
                    @if(Route::has('user.profile.edit'))
                        <a href="{{ route('user.profile.edit') }}" class="btn btn-sm btn-outline-primary">Edit Profile</a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="d-flex gap-3 align-items-center">
                        @include('partials.image-url', ['path' => $user->photo])
                        @if(! empty($url))
                            <img src="{{ $url }}" style="height:80px;width:80px;object-fit:cover;border-radius:8px">
                        @elseif($user->photo)
                            <img src="{{ Storage::url($user->photo) }}" style="height:80px;width:80px;object-fit:cover;border-radius:8px">
                        @else
                            <i class="fas fa-user-circle fa-3x text-muted"></i>
                        @endif

                        <div>
                            <div class="fw-bold">{{ $user->name }}</div>
                            <div class="text-muted small">{{ $user->email }}</div>
                            @if($user->nickname)
                                <div class="text-muted small">Nickname: {{ $user->nickname }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Roles & Permissions -->
        <div class="col-lg-8">
            <div class="table-card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-id-badge me-2 text-primary"></i>Peran & Permissions</h5>
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> {{ $user->email }}</p>

                    <div class="mb-3">
                        <h6>Roles</h6>
                        @if($user->roles->isEmpty())
                            <div class="text-muted">Belum ada peran.</div>
                        @else
                            <ul>
                                @foreach($user->roles as $role)
                                    <li>{{ $role->name }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="mb-3">
                        <h6>Permissions</h6>
                        @if(method_exists($user, 'getAllPermissions') && $user->getAllPermissions()->isNotEmpty())
                            <ul>
                                @foreach($user->getAllPermissions() as $p)
                                    <li>{{ $p->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <ul>
                                <li>kirim opini</li>
                                <li>kirim suara</li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="table-card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-comments me-2 text-primary"></i>Opini Saya</h5>
                    <small class="text-muted">Total: {{ $opiniCounts['total'] }} &middot; Approved: {{ $opiniCounts['approved'] }} &middot; Pending: {{ $opiniCounts['pending'] }}</small>
                </div>
                <div class="card-body">
                        @if(! empty($opinis) && $opinis->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-sm table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Judul</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($opinis as $index => $op)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td class="align-middle">
                                                    <strong>{{ \Illuminate\Support\Str::limit($op->judul, 80) }}</strong>
                                                </td>
                                                <td class="align-middle">
                                                    @if($op->status === 'approved')
                                                        <span class="badge bg-success">Approved</span>
                                                    @elseif($op->status === 'pending')
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @else
                                                        <span class="badge bg-danger">Rejected</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle">{{ $op->created_at->format('d M Y') }}</td>
                                                <td class="align-middle">
                                                    @if($op->status === 'approved' && ! empty($op->slug))
                                                        <a href="{{ route('opini.show', $op->slug) }}" class="btn btn-sm btn-outline-primary">Lihat</a>
                                                    @else
                                                        <a href="{{ route('opini.showById', $op->id) }}" class="btn btn-sm btn-outline-secondary">Lihat</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-muted">Anda belum mengirim opini.</div>
                        @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="table-card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-bullhorn me-2 text-primary"></i>Suara Pembaca Saya</h5>
                    <small class="text-muted">Total: {{ $suaraCounts['total'] }} &middot; Approved: {{ $suaraCounts['approved'] }} &middot; Pending: {{ $suaraCounts['pending'] }}</small>
                </div>
                <div class="card-body">
                        @if(! empty($suaraPembacas) && $suaraPembacas->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-sm table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pesan</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($suaraPembacas as $i => $s)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ \Illuminate\Support\Str::limit($s->pesan, 100) }}</td>
                                                <td>
                                                    @if($s->status === 'approved')
                                                        <span class="badge bg-success">Approved</span>
                                                    @elseif($s->status === 'pending')
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @else
                                                        <span class="badge bg-danger">Rejected</span>
                                                    @endif
                                                </td>
                                                <td>{{ $s->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <a href="{{ route('kirim-suara') }}" class="btn btn-sm btn-outline-primary">Lihat</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-muted">Anda belum mengirim suara pembaca.</div>
                        @endif
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
                    <a href="{{ route('kirim-opini') }}" class="btn btn-primary-custom">
                        <i class="fas fa-plus me-2"></i>Kirim Opini
                    </a>
                    <a href="{{ route('kirim-suara') }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-2"></i>Kirim Suara
                    </a>
                    <a href="{{ route('user.profile.edit') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-user-cog me-2"></i>Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
