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

    // Profile - gabungan fitur lo dan temen lo
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index'); // halaman profile (view)
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // halaman edit profile
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update'); // update profile 
    Route::patch('/profile', [ProfileController::class, 'updatePatch'])->name('profile.update.patch'); // update profile (breeze - kalo masih dipake)
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // delete account (breeze)
    
    Route::post('/logout', [ProfileController::class, 'logout'])->name('logout'); // logout punya lo

    // Pengeluaran (CRUD)
    Route::resource('pengeluaran', PengeluaranController::class);

    // Tabungan (CRUD)
    Route::resource('tabungan', TabunganController::class);
});

require __DIR__.'/auth.php';