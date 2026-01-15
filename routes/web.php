<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\CommentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\OpiniController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\UserPanelController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita', [HomeController::class, 'berita'])->name('berita.index');
Route::get('/berita/{slug}', [HomeController::class, 'showBerita'])->name('berita.show');
Route::post('/berita/{slug}/comments', [CommentController::class, 'store'])->name('berita.comments.store');
Route::get('/opini', [HomeController::class, 'opini'])->name('opini.index');
Route::get('/opini/{slug}', [HomeController::class, 'showOpini'])->name('opini.show');
Route::get('/opini/id/{id}', [HomeController::class, 'showOpiniById'])->name('opini.showById');
Route::get('/tentang-kami', [HomeController::class, 'tentang'])->name('tentang');

Route::get('/kirim-opini', [HomeController::class, 'kirimOpini'])->name('kirim-opini');
Route::post('/kirim-opini', [HomeController::class, 'storeOpini'])->name('kirim-opini.store');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth','ensure.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('berita', BeritaController::class)->parameters(['berita' => 'berita']);
    
    Route::resource('opini', OpiniController::class);
    Route::patch('opini/{opini}/approve', [OpiniController::class, 'approve'])->name('opini.approve');
    Route::patch('opini/{opini}/reject', [OpiniController::class, 'reject'])->name('opini.reject');
    
    // Suara Pembaca feature removed
    
    Route::resource('team', TeamController::class);
    
    // Protect user management to super-admins
    Route::middleware(['role:super-admin'])->group(function () {
        Route::resource('users', UserController::class);
    });
});

// User and Guest panels
Route::get('/user/panel', [UserPanelController::class, 'userPanel'])->name('user.panel')->middleware('auth');
Route::get('/user/profile', [UserPanelController::class, 'editProfile'])->name('user.profile.edit')->middleware('auth');
Route::put('/user/profile', [UserPanelController::class, 'updateProfile'])->name('user.profile.update')->middleware('auth');
Route::get('/guest/panel', [UserPanelController::class, 'guestPanel'])->name('guest.panel')->middleware('guest');
