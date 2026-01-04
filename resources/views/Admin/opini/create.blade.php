@extends('layouts.admin')

@section('title', 'Tambah Opini')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.opini.index') }}" class="text-decoration-none">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Opini
        </a>
    </div>

    <div class="form-card">
        <h5 class="mb-4"><i class="fas fa-plus-circle me-2 text-primary"></i>Tambah Opini Baru</h5>
        
        <form action="{{ route('admin.opini.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <label class="form-label">Judul Opini <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                               value="{{ old('judul') }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Konten Opini <span class="text-danger">*</span></label>
                        <textarea name="konten" class="form-control @error('konten') is-invalid @enderror" 
                                  rows="12" required>{{ old('konten') }}</textarea>
                        @error('konten')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="mb-4">
                        <label class="form-label">Nama Penulis <span class="text-danger">*</span></label>
                        <input type="text" name="penulis_nama" class="form-control @error('penulis_nama') is-invalid @enderror" 
                               value="{{ old('penulis_nama') }}" required>
                        @error('penulis_nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Profesi Penulis</label>
                        <input type="text" name="penulis_profesi" class="form-control @error('penulis_profesi') is-invalid @enderror" 
                               value="{{ old('penulis_profesi') }}">
                        @error('penulis_profesi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Foto Penulis</label>
                        <input type="file" name="penulis_foto" class="form-control @error('penulis_foto') is-invalid @enderror" accept="image/*">
                        @error('penulis_foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <hr class="my-4">
            
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-save me-2"></i>Simpan Opini
                </button>
                <a href="{{ route('admin.opini.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
