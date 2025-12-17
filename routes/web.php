<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\TabunganController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
   return redirect()->route('login');
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


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
   Route::prefix('tabungan')->name('tabungan.')->group(function () {
       Route::get('/', [TabunganController::class, 'index'])->name('index');
       Route::get('/create', [TabunganController::class, 'create'])->name('create');
       Route::post('/', [TabunganController::class, 'store'])->name('store');
       Route::get('/{id}/edit', [TabunganController::class, 'edit'])->name('edit');
       Route::put('/{id}', [TabunganController::class, 'update'])->name('update');
       Route::delete('/{id}', [TabunganController::class, 'destroy'])->name('destroy');
      
       // Routes untuk histori tabungan
       Route::get('/{id}/add-history', [TabunganController::class, 'addHistory'])->name('add-history');
       Route::post('/{id}/store-history', [TabunganController::class, 'storeHistory'])->name('store-history');
   });
});


require __DIR__.'/auth.php';
