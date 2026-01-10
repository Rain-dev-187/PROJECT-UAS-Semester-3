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
        @extends('layouts.public')

        @section('title', 'Kirim Suara - Dihapus')

        @section('content')
            <div class="container py-5">
                <div class="alert alert-info">
                    Fitur "Kirim Suara Pembaca" telah dinonaktifkan. Jika Anda membutuhkan fungsi serupa, silakan hubungi administrator.
                </div>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">Kembali ke Beranda</a>
            </div>
        @endsection
                    <form action="{{ route('kirim-suara.store') }}" method="POST" enctype="multipart/form-data">
