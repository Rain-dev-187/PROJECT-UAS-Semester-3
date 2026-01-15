@extends('layouts.public')

@section('title', 'Edit Opini - PULSA')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        padding: 60px 0;
        color: #fff;
        margin-bottom: 40px;
    }
    
    .form-card {
        background: #fff;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 5px 30px rgba(0,0,0,0.1);
    }
    
    .form-label { font-weight: 600; color: var(--dark); }
    
    .form-control, .form-select {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 15px;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 58, 95, 0.1);
    }
    
    .info-box {
        background: var(--light);
        border-radius: 10px;
        padding: 20px;
        border-left: 4px solid var(--primary);
    }

    .status-badge {
        display: inline-block;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .status-badge.pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-badge.rejected {
        background-color: #f8d7da;
        color: #721c24;
    }
</style>
@endpush

@section('content')
    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-edit me-3"></i>Edit Opini</h1>
            <p class="mb-0 opacity-75">Perbarui opini Anda</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if($opini->status !== 'approved')
                    <div class="info-box mb-4">
                        <div class="d-flex gap-2">
                            <div>
                                <h6 class="mb-1"><i class="fas fa-info-circle me-2"></i>Informasi</h6>
                                <p class="mb-0 small">Opini Anda sedang menunggu persetujuan admin. Anda dapat mengedit opini ini. Ketika Anda menyimpan perubahan, status akan direset ke "Pending" dan akan ditinjau ulang oleh admin.</p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-card">
                    <div class="mb-4">
                        <span class="status-badge {{ $opini->status }}">
                            Status: <strong>{{ ucfirst($opini->status) }}</strong>
                        </span>
                    </div>

                    <form action="{{ route('user.opini.update', $opini->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="form-label">Judul Opini <span class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                                   value="{{ old('judul', $opini->judul) }}" placeholder="Masukkan judul opini Anda" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Isi Opini <span class="text-danger">*</span></label>
                            <textarea name="konten" class="form-control @error('konten') is-invalid @enderror" 
                                      rows="10" placeholder="Tulis opini Anda di sini (minimal 100 karakter)" required>{{ old('konten', $opini->konten) }}</textarea>
                            @error('konten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <hr class="my-4">
                        <h6 class="mb-3">Informasi Penulis</h6>
                        
                        <!-- Display user info -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->email }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Profesi</label>
                                <input type="text" name="penulis_profesi" class="form-control @error('penulis_profesi') is-invalid @enderror" 
                                       value="{{ old('penulis_profesi', $opini->penulis_profesi) }}" placeholder="Contoh: Mahasiswa, Guru, dll">
                                @error('penulis_profesi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Foto Profil</label>
                                @if($opini->penulis_foto)
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($opini->penulis_foto) }}" alt="Foto Profil" style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px;">
                                        <p class="text-muted small mt-2">Foto saat ini</p>
                                    </div>
                                @endif
                                <input type="file" name="penulis_foto" class="form-control @error('penulis_foto') is-invalid @enderror" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah.</small>
                                @error('penulis_foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                            <a href="{{ route('user.panel') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
