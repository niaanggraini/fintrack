<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TrackerController;



Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/transaksi/create', [TransaksiController::class, 'create'])
    ->name('transaksi.create');

Route::post('/transaksi', [TransaksiController::class, 'store'])
    ->middleware('auth')
    ->name('transaksi.store');

    // Routes Tracker
    Route::get('/tracker', [TrackerController::class, 'index'])->name('tracker.index');
    Route::get('/tracker/create', [TrackerController::class, 'create'])->name('tracker.create');
    Route::post('/tracker', [TrackerController::class, 'store'])->name('tracker.store');
    Route::post('/tracker/tambah', [TrackerController::class, 'tambah'])->name('tracker.tambah');
    Route::delete('/tracker/{tracker}', [TrackerController::class, 'destroy'])->name('tracker.destroy');

Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile', [ProfileController::class, 'updatePatch'])->name('profile.update.patch');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');

    // Pengeluaran (CRUD)
    Route::resource('pengeluaran', PengeluaranController::class);

    // Tabungan (CRUD)
    Route::prefix('tabungan')->name('tabungan.')->group(function () {
        Route::get('/', [TabunganController::class, 'index'])->name('index');
        Route::get('/create', [TabunganController::class, 'create'])->name('create');
        Route::post('/', [TabunganController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TabunganController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TabunganController::class, 'update'])->name('update');
        Route::delete('/{id}', [TabunganController::class, 'destroy'])->name('destroy');

        // Histori Tabungan
        Route::get('/{id}/add-history', [TabunganController::class, 'addHistory'])->name('add-history');
        Route::post('/{id}/store-history', [TabunganController::class, 'storeHistory'])->name('store-history');
    });
});

require __DIR__ . '/auth.php';
