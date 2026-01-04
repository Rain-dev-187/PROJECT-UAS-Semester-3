@extends('layouts.admin')

@section('title', 'Tambah Berita')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.berita.index') }}" class="text-decoration-none">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Berita
        </a>
    </div>

    <div class="form-card">
        <h5 class="mb-4"><i class="fas fa-plus-circle me-2 text-primary"></i>Tambah Berita Baru</h5>
        
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <label class="form-label">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                               value="{{ old('judul') }}" placeholder="Masukkan judul berita" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Ringkasan</label>
                        <textarea name="ringkasan" class="form-control @error('ringkasan') is-invalid @enderror" 
                                  rows="3" placeholder="Ringkasan singkat berita (opsional)">{{ old('ringkasan') }}</textarea>
                        @error('ringkasan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Konten Berita <span class="text-danger">*</span></label>
                        <textarea name="konten" class="form-control @error('konten') is-invalid @enderror" 
                                  rows="15" placeholder="Tulis konten berita di sini" required>{{ old('konten') }}</textarea>
                        @error('konten')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="mb-4">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                            <option value="">Pilih Kategori</option>
                            <option value="politik" {{ old('kategori') == 'politik' ? 'selected' : '' }}>Politik</option>
                            <option value="ekonomi" {{ old('kategori') == 'ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                            <option value="sosial" {{ old('kategori') == 'sosial' ? 'selected' : '' }}>Sosial</option>
                            <option value="budaya" {{ old('kategori') == 'budaya' ? 'selected' : '' }}>Budaya</option>
                            <option value="teknologi" {{ old('kategori') == 'teknologi' ? 'selected' : '' }}>Teknologi</option>
                            <option value="olahraga" {{ old('kategori') == 'olahraga' ? 'selected' : '' }}>Olahraga</option>
                            <option value="hiburan" {{ old('kategori') == 'hiburan' ? 'selected' : '' }}>Hiburan</option>
                            <option value="umum" {{ old('kategori') == 'umum' ? 'selected' : '' }}>Umum</option>
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Gambar</label>
                        <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" 
                               accept="image/*" onchange="previewImage(this)">
                        <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="mt-3">
                            <img id="preview" src="" alt="" class="img-preview d-none">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="form-check">
                            <input type="checkbox" name="is_headline" value="1" class="form-check-input" 
                                   id="is_headline" {{ old('is_headline') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_headline">
                                <strong>Jadikan Headline</strong>
                                <br><small class="text-muted">Tampilkan di bagian utama halaman depan</small>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr class="my-4">
            
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-save me-2"></i>Simpan Berita
                </button>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
