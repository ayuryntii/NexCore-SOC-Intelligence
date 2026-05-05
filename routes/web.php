<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\KaryawanController;

// Route yang sudah ada sebelumnya
Route::get('/', function () {
    return view('welcome');
});

Route::get('/belajar-route', function () {
    return 'Selamat Datang di Belajar-Route';
});

Route::get('/dosen', function () {
    return view('dosen');
});

// ========== ROUTE UNTUK TUGAS PORTFOLIO ==========
Route::get('/home', [PortfolioController::class, 'home'])->name('home');
Route::get('/about', [PortfolioController::class, 'about'])->name('about');
Route::get('/education', [PortfolioController::class, 'education'])->name('education');
Route::get('/project', [PortfolioController::class, 'project'])->name('project');

// ========== ROUTE UNTUK TUGAS CRUD KARYAWAN ==========
Route::resource('karyawan', KaryawanController::class);

// ========== PORTAL BERITA TEKNOLOGI & CYBER SECURITY ==========
use App\Http\Controllers\User\NewsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;

// Public Routes
Route::get('/', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
    Route::resource('categories', CategoryController::class)->except(['show', 'create', 'edit']);
    Route::resource('posts', PostController::class);
});


