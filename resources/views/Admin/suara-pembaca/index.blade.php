@extends('layouts.admin')

@section('title', 'Suara Pembaca')

@section('content')
    <div class="mb-4">
        <h4 class="mb-1">Suara Pembaca</h4>
        <p class="text-muted mb-0">Kelola aspirasi dan suara dari pembaca</p>
    </div>

    <div class="table-card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Nama</th>
                        <th>Pesan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suaras as $index => $suara)
                        <tr>
                            <td>{{ $suaras->firstItem() + $index }}</td>
                            <td>
                                <strong>{{ $suara->nama }}</strong>
                                <br>
                                <small class="text-muted">{{ $suara->email }}</small>
                                <br>
                                <small class="text-muted">{{ $suara->profesi ?? '-' }}</small>
                            </td>
                            <td>{{ Str::limit($suara->pesan, 80) }}</td>
                            <td>
                                <span class="badge-status badge-{{ $suara->status }}">
                                    {{ ucfirst($suara->status) }}
                                </span>
                            </td>
                            <td>{{ $suara->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    @if($suara->status == 'pending')
                                        <form action="{{ route('admin.suara-pembaca.approve', $suara) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-outline-success" title="Setujui">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.suara-pembaca.reject', $suara) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-outline-warning" title="Tolak">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.suara-pembaca.destroy', $suara) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus?')">
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
                                <i class="fas fa-bullhorn fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Belum ada suara pembaca</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($suaras->hasPages())
            <div class="card-footer bg-white">
                {{ $suaras->links() }}
            </div>
        @endif
    </div>
@endsection
