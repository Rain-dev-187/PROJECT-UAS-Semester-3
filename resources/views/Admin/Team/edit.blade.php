@extends('layouts.admin')

@section('title', 'Edit Anggota Tim')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.team.index') }}" class="text-decoration-none">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Tim
        </a>
    </div>

    <div class="form-card">
        <h5 class="mb-4">
            <i class="fas fa-edit me-2 text-primary"></i>
            Edit Anggota Tim
        </h5>
        
        <form action="{{ route('admin.team.update', $team) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                           value="{{ old('nama', $team->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-4">
                    <label class="form-label">NPM</label>
                    <input type="text" name="npm" class="form-control @error('npm') is-invalid @enderror" 
                           value="{{ old('npm', $team->npm) }}">
                    @error('npm')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" 
                           value="{{ old('jabatan', $team->jabatan) }}">
                    @error('jabatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-4">
                    <label class="form-label">Urutan</label>
                    <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror" 
                           value="{{ old('urutan', $team->urutan) }}">
                    @error('urutan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-4">
                <label class="form-label">Foto</label>
                @if($team->foto)
                    <div class="mb-3">
                        <img src="{{ asset('storage/'.$team->foto) }}" alt="" class="img-preview">
                    </div>
                @endif
                <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <div class="form-check">
                    <input type="checkbox" name="is_active" value="1" class="form-check-input" 
                           id="is_active" {{ old('is_active', $team->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        Aktif
                    </label>
                </div>
            </div>
            
            <hr class="my-4">
            
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-save me-2"></i>Update
                </button>
                <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
