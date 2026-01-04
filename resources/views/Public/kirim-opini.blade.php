@extends('layouts.public')

@section('title', 'Kirim Opini - PULSA')

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
</style>
@endpush

@section('content')
    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-paper-plane me-3"></i>Kirim Opini</h1>
            <p class="mb-0 opacity-75">Sampaikan pendapat dan pandangan Anda</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="info-box mb-4">
                    <h6 class="mb-2"><i class="fas fa-info-circle me-2"></i>Informasi</h6>
                    <p class="mb-0 small">Opini yang Anda kirimkan akan ditinjau terlebih dahulu oleh tim redaksi sebelum dipublikasikan. Pastikan opini Anda tidak mengandung SARA, ujaran kebencian, atau konten yang melanggar hukum.</p>
                </div>

                <div class="form-card">
                    <form action="{{ route('kirim-opini.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label">Judul Opini <span class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                                   value="{{ old('judul') }}" placeholder="Masukkan judul opini Anda" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Isi Opini <span class="text-danger">*</span></label>
                            <textarea name="konten" class="form-control @error('konten') is-invalid @enderror" 
                                      rows="10" placeholder="Tulis opini Anda di sini (minimal 100 karakter)" required>{{ old('konten') }}</textarea>
                            @error('konten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <hr class="my-4">
                        <h6 class="mb-3">Informasi Penulis</h6>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="penulis_nama" class="form-control @error('penulis_nama') is-invalid @enderror" 
                                       value="{{ old('penulis_nama') }}" placeholder="Nama Anda" required>
                                @error('penulis_nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Profesi</label>
                                <input type="text" name="penulis_profesi" class="form-control @error('penulis_profesi') is-invalid @enderror" 
                                       value="{{ old('penulis_profesi') }}" placeholder="Contoh: Mahasiswa, Guru, dll">
                                @error('penulis_profesi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Foto Profil</label>
                            <input type="file" name="penulis_foto" class="form-control @error('penulis_foto') is-invalid @enderror" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                            @error('penulis_foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Opini
                            </button>
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
