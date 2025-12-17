<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\TabunganController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profile (default Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pengeluaran (CRUD)
    Route::resource('pengeluaran', PengeluaranController::class);

    // Tabungan (CRUD)
    Route::resource('tabungan', TabunganController::class);
});

require __DIR__.'/auth.php';
