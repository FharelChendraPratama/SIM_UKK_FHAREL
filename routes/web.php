<?php

use Illuminate\Routing\ResolvesRouteDependencies;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\admin\SiswaController;
use App\Http\Controllers\admin\AspirasiController;
use App\Http\Controllers\admin\AspirasiSelesaiController;

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->group(function () {
   Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
   Route::resource('kategori', KategoriController::class);
   Route::resource('siswa', SiswaController::class);
   Route::resource('aspirasi', AspirasiController::class);
   Route::resource('aspirasi-selesai', AspirasiSelesaiController::class);
});

Route::prefix('siswa')->name('siswa.')->group(function () {
   Route::get('/dashboard', [DashboardController::class, 'siswa'])->name('dashboard');
   Route::resource('input_aspirasi', \App\Http\Controllers\siswa\InputAspirasiController::class);
   Route::resource('aspirasi', \App\Http\Controllers\siswa\AspirasiController::class);
});
