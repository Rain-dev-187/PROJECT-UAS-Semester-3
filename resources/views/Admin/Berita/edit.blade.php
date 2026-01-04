@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.berita.index') }}" class="text-decoration-none">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Berita
        </a>
    </div>

    <div class="form-card">
        <h5 class="mb-4"><i class="fas fa-edit me-2 text-primary"></i>Edit Berita</h5>
        
        <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <label class="form-label">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                               value="{{ old('judul', $berita->judul) }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Ringkasan</label>
                        <textarea name="ringkasan" class="form-control @error('ringkasan') is-invalid @enderror" 
                                  rows="3">{{ old('ringkasan', $berita->ringkasan) }}</textarea>
                        @error('ringkasan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Konten Berita <span class="text-danger">*</span></label>
                        <textarea name="konten" class="form-control @error('konten') is-invalid @enderror" 
                                  rows="15" required>{{ old('konten', $berita->konten) }}</textarea>
                        @error('konten')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="mb-4">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                            @foreach(['politik', 'ekonomi', 'sosial', 'budaya', 'teknologi', 'olahraga', 'hiburan', 'umum'] as $kat)
                                <option value="{{ $kat }}" {{ old('kategori', $berita->kategori) == $kat ? 'selected' : '' }}>
                                    {{ ucfirst($kat) }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="draft" {{ old('status', $berita->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $berita->status) == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status', $berita->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Gambar</label>
                        @if($berita->gambar)
                            <div class="mb-3">
                                <img src="{{ asset('storage/'.$berita->gambar) }}" alt="" class="img-preview">
                                <p class="small text-muted mt-2">Gambar saat ini</p>
                            </div>
                        @endif
                        <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" 
                               accept="image/*" onchange="previewImage(this)">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
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
                                   id="is_headline" {{ old('is_headline', $berita->is_headline) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_headline">
                                <strong>Jadikan Headline</strong>
                            </label>
                        </div>
                    </div>
                    
                    <div class="p-3 bg-light rounded">
                        <small class="text-muted">
                            <strong>Info:</strong><br>
                            Dibuat: {{ $berita->created_at->format('d M Y H:i') }}<br>
                            Diupdate: {{ $berita->updated_at->format('d M Y H:i') }}<br>
                            Views: {{ number_format($berita->views) }}
                        </small>
                    </div>
                </div>
            </div>
            
            <hr class="my-4">
            
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-save me-2"></i>Update Berita
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
