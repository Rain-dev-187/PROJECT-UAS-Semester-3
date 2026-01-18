@extends('layouts.legacy_user')

@section('title', 'Edit Profile')
@section('panel_label', 'Edit Profile')

@push('styles')
<style>
    .profile-header {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
    }
    .profile-header::after {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100%;
        background: rgba(255,255,255,0.05);
        transform: skewX(-20deg) translateX(30px);
    }
    .profile-header .content {
        position: relative;
        z-index: 2;
    }
    .avatar-upload {
        position: relative;
        width: 70px;
        height: 70px;
        margin: 0 auto 10px;
    }
    .avatar-upload img,
    .avatar-upload .avatar-placeholder {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #fff;
    }
    .avatar-placeholder {
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: bold;
    }
    .profile-header h2 {
        font-size: 1.4rem;
        margin-bottom: 3px !important;
    }
    .profile-header p {
        font-size: 0.85rem;
    }
    .profile-form-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        padding: 25px;
        margin-bottom: 20px;
    }
    .form-section-title {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 15px;
        padding-bottom: 8px;
        border-bottom: 2px solid #e0e0e0;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 6px;
        font-size: 0.9rem;
    }
    .form-control {
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 8px 12px;
        font-size: 0.9rem;
    }
    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 58, 95, 0.1);
    }
    .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        border: none;
        border-radius: 6px;
        padding: 10px 24px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(30, 58, 95, 0.3);
        color: white;
    }
    .btn-secondary-custom {
        background: #f0f0f0;
        color: #333;
        border: none;
        border-radius: 6px;
        padding: 10px 24px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s;
    }
    .btn-secondary-custom:hover {
        background: #e0e0e0;
        color: #333;
    }
    #photoPreview {
        max-width: 100%;
        max-height: 250px;
        border-radius: 6px;
        margin-top: 8px;
        display: none;
    }
</style>
@endpush

@section('content')
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="content">
            <div class="avatar-upload">
                @if($user->photo)
                    <img src="{{ Storage::url($user->photo) }}" alt="Profile Photo" id="avatarDisplay">
                @else
                    <div class="avatar-placeholder" id="avatarDisplay">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
            </div>
            <h2 class="mb-1">{{ $user->name }}</h2>
            <p class="mb-0 opacity-75">{{ $user->email }}</p>
        </div>
    </div>

    <!-- Edit Profile Form -->
    <div class="row">
        <div class="col-lg-7 mx-auto">
            <div class="profile-form-card">
                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Personal Information Section -->
                    <h5 class="form-section-title">Informasi Pribadi</h5>

                    <div class="form-group">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nama Panggilan</label>
                        <input type="text" name="nickname" class="form-control @error('nickname') is-invalid @enderror"
                               value="{{ old('nickname', $user->nickname) }}" placeholder="Opsional">
                        @error('nickname')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Profesi</label>
                        <input type="text" name="profesi" class="form-control @error('profesi') is-invalid @enderror"
                               value="{{ old('profesi', $user->profesi) }}" placeholder="Opsional">
                        @error('profesi')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Photo Upload Section -->
                    <h5 class="form-section-title mt-4">Foto Profil</h5>

                    <div class="form-group">
                        <label class="form-label">Upload Foto Baru</label>
                        <input type="file" name="photo" id="photoInput" class="form-control @error('photo') is-invalid @enderror" 
                               accept="image/*">
                        <small class="text-muted d-block mt-2">Format: JPG, PNG, GIF (Max 2MB)</small>
                        @error('photo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <img id="photoPreview" alt="Preview">
                    </div>

                    <!-- Security Section -->
                    <h5 class="form-section-title mt-4">Keamanan</h5>

                    <div class="form-group">
                        <label class="form-label">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="Masukkan password baru">
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                               placeholder="Konfirmasi password baru">
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('user.panel') }}" class="btn btn-secondary-custom">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.getElementById('photoInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('photoPreview');
                preview.src = event.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
