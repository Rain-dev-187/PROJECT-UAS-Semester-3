@extends('layouts.admin')

@section('title', 'Manajemen User')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Manajemen User</h4>
            <p class="text-muted mb-0">Kelola user dan role akses (Super Admin Only)</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary-custom">
            <i class="fas fa-plus me-2"></i>Tambah User
        </a>
    </div>

    <div class="table-card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Terdaftar</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $index }}</td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="badge bg-primary">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Belum ada user</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($users->hasPages())
            <div class="card-footer bg-white">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
