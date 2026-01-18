@extends('layouts.admin')

@section('title', 'Edit Opini')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.opini.index') }}" class="text-decoration-none">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Opini
        </a>
    </div>

    <div class="form-card">
        <h5 class="mb-4"><i class="fas fa-edit me-2 text-primary"></i>Edit Opini</h5>
        
        <form action="{{ route('admin.opini.update', $opini) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <label class="form-label">Judul Opini <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                               value="{{ old('judul', $opini->judul) }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Konten Opini <span class="text-danger">*</span></label>
                        <textarea name="konten" class="form-control @error('konten') is-invalid @enderror" 
                                  rows="12" required>{{ old('konten', $opini->konten) }}</textarea>
                        @error('konten')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="mb-4">
                        <label class="form-label">Nama Penulis <span class="text-danger">*</span></label>
                        <input type="text" name="penulis_nama" class="form-control @error('penulis_nama') is-invalid @enderror" 
                               value="{{ old('penulis_nama', $opini->penulis_nama) }}" required>
                        @error('penulis_nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Profesi Penulis</label>
                        <input type="text" name="penulis_profesi" class="form-control @error('penulis_profesi') is-invalid @enderror" 
                               value="{{ old('penulis_profesi', $opini->penulis_profesi) }}">
                        @error('penulis_profesi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Foto Penulis</label>
                        @if($opini->penulis_foto)
                            <div class="mb-3">
                                <img src="{{ asset('storage/'.$opini->penulis_foto) }}" alt="" style="max-width: 150px; height: auto; border-radius: 8px;">
                            </div>
                        @endif
                        <input type="file" name="penulis_foto" class="form-control @error('penulis_foto') is-invalid @enderror" accept="image/*">
                        @error('penulis_foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="pending" {{ old('status', $opini->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ old('status', $opini->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ old('status', $opini->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
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
                    <i class="fas fa-save me-2"></i>Update Opini
                </button>
                <a href="{{ route('admin.opini.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
