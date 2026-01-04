@extends('layouts.public')

@section('title', 'Guest Panel')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-custom p-4 text-center">
                <h4 class="section-title">Guest Panel</h4>
                <p class="lead">Selamat datang, tamu! Anda dapat mendaftar untuk ikut berkontribusi.</p>
                <div class="d-flex justify-content-center gap-2 mt-3">
                    <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
                    <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
