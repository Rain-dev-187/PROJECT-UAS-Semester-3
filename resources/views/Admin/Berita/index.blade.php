@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Kelola Berita</h4>
            <p class="text-muted mb-0">Kelola semua berita yang ada di website</p>
        </div>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary-custom">
            <i class="fas fa-plus me-2"></i>Tambah Berita
        </a>
    </div>

    <div class="table-card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th>Tanggal</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beritas as $index => $berita)
                        <tr>
                            <td>{{ $beritas->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($berita->gambar)
                                        <img src="{{ asset('storage/'.$berita->gambar) }}" 
                                             alt="" class="rounded me-3" style="width:50px;height:50px;object-fit:cover;">
                                    @else
                                        <div class="rounded me-3 bg-light d-flex align-items-center justify-content-center" 
                                             style="width:50px;height:50px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <strong>{{ Str::limit($berita->judul, 40) }}</strong>
                                        @if($berita->is_headline)
                                            <span class="badge bg-warning text-dark ms-2">Headline</span>
                                        @endif
                                        <br>
                                        <small class="text-muted">{{ $berita->user->name ?? 'Admin' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-secondary">{{ ucfirst($berita->kategori) }}</span></td>
                            <td>
                                <span class="badge-status badge-{{ $berita->status }}">
                                    {{ ucfirst($berita->status) }}
                                </span>
                            </td>
                            <td>{{ number_format($berita->views) }}</td>
                            <td>{{ $berita->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    @if($berita->status === 'published')
                                    <a href="{{ route('berita.show', $berita->slug) }}" 
                                       class="btn btn-outline-secondary" target="_blank" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @else
                                    <a href="{{ route('admin.berita.edit', $berita) }}" 
                                       class="btn btn-outline-secondary" title="Preview / Edit (not published)">
                                        <i class="fas fa-eye-slash"></i>
                                    </a>
                                    @endif
                                    <a href="{{ route('admin.berita.edit', $berita) }}" 
                                       class="btn btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.berita.destroy', $berita) }}" method="POST" 
                                          class="d-inline" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
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
                            <td colspan="7" class="text-center py-5">
                                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Belum ada berita</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($beritas->hasPages())
            <div class="card-footer bg-white">
                {{ $beritas->links() }}
            </div>
        @endif
    </div>
@endsection
