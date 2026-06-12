<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PlayboxController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\EventPromoController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\AktivitasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// Admin route group
Route::middleware('auth')->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Monitoring Playbox
    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('admin.monitoring');

    // Manajemen Playbox (CRUD)
    Route::resource('/playbox', PlayboxController::class)->names('admin.playbox');

    // Manajemen Game (CRUD)
    Route::resource('/game', GameController::class)->names('admin.game');

    // Manajemen Cabang (CRUD)
    Route::resource('/cabang', CabangController::class)->names('admin.cabang');

    // Event & Promo (CRUD)
    Route::resource('/promo', EventPromoController::class)->names('admin.promo');

    // Data Pelanggan (Read-only)
    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('admin.pelanggan');

    // Riwayat Bermain (Read-only)
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('admin.riwayat');

    // Laporan & Statistik
    Route::get('/statistik', [StatistikController::class, 'index'])->name('admin.statistik');
    Route::get('/statistik/export-pdf', [StatistikController::class, 'exportPdf'])->name('admin.statistik.export-pdf');
    Route::get('/statistik/export-excel', [StatistikController::class, 'exportExcel'])->name('admin.statistik.export-excel');

    // Riwayat Aktivitas (Audit Trail)
    Route::get('/aktivitas', [AktivitasController::class, 'index'])->name('admin.aktivitas');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
