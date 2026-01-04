@extends('layouts.legacy_user')

@section('title', 'Edit Profile')
@section('panel_label', 'User Panel')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="form-card">
                <h5 class="mb-4"><i class="fas fa-user-edit me-2 text-primary"></i>Edit Profile</h5>

                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nickname</label>
                        <input type="text" name="nickname" class="form-control" value="{{ old('nickname', auth()->user()->nickname) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto (avatar)</label>
                        @include('partials.image-url', ['path' => auth()->user()->photo])
                        @if(! empty($url))
                            <div class="mb-2"><img src="{{ $url }}" style="height:80px;border-radius:8px"></div>
                        @endif
                        <input type="file" name="photo" accept="image/*" class="form-control">
                    </div>

                    <hr>

                    <h6>Ubah Password</h6>
                    <div class="mb-3">
                        <label class="form-label">Password Baru (kosongkan jika tidak ingin mengubah)</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-primary-custom" type="submit">Simpan</button>
                        @php
                            $backRoute = (auth()->check() && method_exists(auth()->user(), 'hasAnyRole') && auth()->user()->hasAnyRole(['super-admin','staff'])) ? route('admin.dashboard') : route('user.panel');
                        @endphp
                        <a href="{{ $backRoute }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
