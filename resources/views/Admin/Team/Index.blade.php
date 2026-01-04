@extends('layouts.admin')

@section('title', 'Kelola Tim')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Kelola Tim / Anggota</h4>
            <p class="text-muted mb-0">Kelola anggota tim PULSA</p>
        </div>
        <a href="{{ route('admin.team.create') }}" class="btn btn-primary-custom">
            <i class="fas fa-plus me-2"></i>Tambah Anggota
        </a>
    </div>

    <div class="table-card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>NPM</th>
                        <th>Jabatan</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teams as $index => $team)
                        <tr>
                            <td>{{ $teams->firstItem() + $index }}</td>
                            <td>
                                <img src="{{ $team->foto ? asset('storage/'.$team->foto) : 'https://ui-avatars.com/api/?name='.urlencode($team->nama).'&size=50' }}" 
                                     alt="" class="rounded" style="width:50px;height:50px;object-fit:cover;">
                            </td>
                            <td><strong>{{ $team->nama }}</strong></td>
                            <td>{{ $team->npm ?? '-' }}</td>
                            <td>{{ $team->jabatan ?? '-' }}</td>
                            <td>{{ $team->urutan }}</td>
                            <td>
                                @if($team->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.team.edit', $team) }}" class="btn btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.team.destroy', $team) }}" method="POST" class="d-inline"
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
                            <td colspan="8" class="text-center py-5">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Belum ada anggota tim</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($teams->hasPages())
            <div class="card-footer bg-white">
                {{ $teams->links() }}
            </div>
        @endif
    </div>
@endsection
