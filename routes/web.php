<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLaporanController;
use App\Http\Controllers\Admin\AdminSppdController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Staf\StafDashboardController;
use App\Http\Controllers\Staf\StafSppdController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', AdminUserController::class)->except(['show']);
    Route::resource('sppd', AdminSppdController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);

    Route::get('laporan', [AdminLaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/export', [AdminLaporanController::class, 'export'])->name('laporan.export');
});

Route::middleware(['auth', 'is_staf'])->prefix('staf')->name('staf.')->group(function () {
    Route::get('/dashboard', [StafDashboardController::class, 'index'])->name('dashboard');

    Route::get('sppd/create', [StafSppdController::class, 'create'])->name('sppd.create');
    Route::post('sppd', [StafSppdController::class, 'store'])->name('sppd.store');
    Route::get('sppd/{sppd}', [StafSppdController::class, 'show'])->name('sppd.show');
});
