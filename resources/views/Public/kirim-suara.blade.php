@extends('layouts.public')

@section('title', 'Kirim Suara Pembaca - PULSA')

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
    
    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 15px;
    }
    
    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 58, 95, 0.1);
    }
    
    .info-box {
        background: var(--light);
        border-radius: 10px;
        padding: 20px;
        border-left: 4px solid var(--accent);
    }
</style>
@endpush

@section('content')
    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-bullhorn me-3"></i>Kirim Suara Pembaca</h1>
            <p class="mb-0 opacity-75">Sampaikan aspirasi, kritik, dan saran Anda</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="info-box mb-4">
                    <h6 class="mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Tips</h6>
                    <p class="mb-0 small">Suara pembaca yang konstruktif dan sopan akan lebih mudah untuk dipublikasikan. Hindari kata-kata kasar atau menyinggung pihak tertentu.</p>
                </div>

                <div class="form-card">
                    <form action="{{ route('kirim-suara.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                                       value="{{ old('nama') }}" placeholder="Nama Anda" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email') }}" placeholder="email@contoh.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Profesi</label>
                            <input type="text" name="profesi" class="form-control @error('profesi') is-invalid @enderror" 
                                   value="{{ old('profesi') }}" placeholder="Contoh: Mahasiswa, Wiraswasta, dll">
                            @error('profesi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Pesan / Aspirasi <span class="text-danger">*</span></label>
                            <textarea name="pesan" class="form-control @error('pesan') is-invalid @enderror" 
                                      rows="6" placeholder="Tulis pesan, aspirasi, kritik, atau saran Anda (minimal 20 karakter, maksimal 500 karakter)" required>{{ old('pesan') }}</textarea>
                            <small class="text-muted">Minimal 20 karakter, maksimal 500 karakter</small>
                            @error('pesan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Foto (Opsional)</label>
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-accent">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Suara
                            </button>
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
