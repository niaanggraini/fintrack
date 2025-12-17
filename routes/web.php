<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\TabunganController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;



// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Routes yang butuh authentication
Route::middleware('auth')->group(function () {

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');

    // Pengeluaran Routes
    Route::resource('pengeluaran', PengeluaranController::class);

    // Tabungan Routes
    Route::resource('tabungan', TabunganController::class);

    Route::post('/transaksi', [TransaksiController::class, 'store'])
        ->name('transaksi.store');
});

// Auth routes (login, register, password reset, dll)
require __DIR__.'/auth.php';
