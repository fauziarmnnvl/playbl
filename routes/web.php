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

/*
|--------------------------------------------------------------------------
| Landing Page (Public)
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome')->name('home');

Route::view('/branch', 'branches')->name('branch');

Route::view('/event-promo', 'events-promos')->name('event-promo');

Route::view('/game', 'games')->name('game');

Route::view('/booking', 'bookings.info')->name('booking.info');

Route::view('/booking/cabang', 'bookings.cabang')->name('booking.cabang');

Route::view('/booking/playbox', 'bookings.playbox')->name('booking.playbox');

Route::view('/booking/durasi', 'bookings.durasi')->name('booking.durasi');

Route::view('/booking/review', 'bookings.review')->name('booking.review');

Route::view('/booking/pembayaran', 'bookings.pembayaran')->name('booking.pembayaran');

Route::view('/booking/success', 'bookings.success')->name('booking.success');


/*
|--------------------------------------------------------------------------
| Admin Area
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Monitoring Playbox
    Route::get('/monitoring', [MonitoringController::class, 'index'])
        ->name('admin.monitoring');

    // Playbox
    Route::resource('/playbox', PlayboxController::class)
        ->names('admin.playbox');

    // Game
    Route::resource('/game', GameController::class)
        ->names('admin.game');

    // Cabang
    Route::resource('/cabang', CabangController::class)
        ->names('admin.cabang');

    // Promo
    Route::resource('/promo', EventPromoController::class)
        ->names('admin.promo');

    // Pelanggan
    Route::get('/pelanggan', [PelangganController::class, 'index'])
        ->name('admin.pelanggan');

    // Riwayat
    Route::get('/riwayat', [RiwayatController::class, 'index'])
        ->name('admin.riwayat');

    // Statistik
    Route::get('/statistik', [StatistikController::class, 'index'])
        ->name('admin.statistik');

    Route::get('/statistik/export-pdf', [StatistikController::class, 'exportPdf'])
        ->name('admin.statistik.export-pdf');

    Route::get('/statistik/export-excel', [StatistikController::class, 'exportExcel'])
        ->name('admin.statistik.export-excel');

    // Aktivitas
    Route::get('/aktivitas', [AktivitasController::class, 'index'])
        ->name('admin.aktivitas');
});

/*
|--------------------------------------------------------------------------
| User Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';