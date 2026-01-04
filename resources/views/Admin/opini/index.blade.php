@extends('layouts.admin')

@section('title', 'Kelola Opini Publik')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Kelola Opini Publik</h4>
            <p class="text-muted mb-0">Review dan kelola opini dari masyarakat</p>
        </div>
        <a href="{{ route('admin.opini.create') }}" class="btn btn-primary-custom">
            <i class="fas fa-plus me-2"></i>Tambah Opini
        </a>
    </div>

    <div class="table-card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Opini</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($opinis as $index => $opini)
                        <tr>
                            <td>{{ $opinis->firstItem() + $index }}</td>
                            <td>
                                <strong>{{ Str::limit($opini->judul, 50) }}</strong>
                                <br>
                                <small class="text-muted">{{ Str::limit(strip_tags($opini->konten), 60) }}</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $opini->penulis_foto ? asset('storage/'.$opini->penulis_foto) : 'https://ui-avatars.com/api/?name='.urlencode($opini->penulis_nama).'&size=40' }}" 
                                         alt="" class="rounded-circle me-2" style="width:40px;height:40px;object-fit:cover;">
                                    <div>
                                        <strong>{{ $opini->penulis_nama }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $opini->penulis_profesi ?? '-' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge-status badge-{{ $opini->status }}">
                                    {{ ucfirst($opini->status) }}
                                </span>
                            </td>
                            <td>{{ $opini->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    @if($opini->status == 'pending')
                                        <form action="{{ route('admin.opini.approve', $opini) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-outline-success" title="Setujui">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.opini.reject', $opini) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-outline-warning" title="Tolak">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('admin.opini.edit', $opini) }}" class="btn btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.opini.destroy', $opini) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus opini ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Belum ada opini</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($opinis->hasPages())
            <div class="card-footer bg-white">
                {{ $opinis->links() }}
            </div>
        @endif
    </div>
@endsection
