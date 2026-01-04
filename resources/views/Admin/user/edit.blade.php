@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar User
        </a>
    </div>

    <div class="form-card">
        <h5 class="mb-4">
            <i class="fas fa-edit me-2 text-primary"></i>
            Edit User
        </h5>
        
        <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="form-label">Nama <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Nickname</label>
                <input type="text" name="nickname" class="form-control @error('nickname') is-invalid @enderror" 
                       value="{{ old('nickname', $user->nickname) }}">
                @error('nickname')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Foto (avatar)</label>
                @if($user->photo)
                    <div class="mb-2">
                        <img src="{{ Storage::url($user->photo) }}" alt="avatar" style="height:80px;border-radius:8px;">
                    </div>
                @endif
                <input type="file" name="photo" accept="image/*" class="form-control @error('photo') is-invalid @enderror">
                @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <label class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <label class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            
            <div class="mb-4">
                <label class="form-label">Role <span class="text-danger">*</span></label>
                <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                    <option value="">Pilih Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" 
                            {{ old('role', $user->roles->first() ? $user->roles->first()->name : '') == $role->name ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <hr class="my-4">
            
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-save me-2"></i>Update
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
