<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransaksiController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Route untuk autentikasi
Auth::routes();

// Route untuk halaman home setelah login
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');


// Route untuk mengelola penyewa
Route::prefix('penyewa')->name('penyewa.')->group(function () {
    Route::get('/', [PenyewaController::class, 'index'])->name('index'); // Menampilkan daftar penyewa
    Route::get('/create', [PenyewaController::class, 'create'])->name('create'); // Form untuk menambahkan penyewa baru
    Route::post('/store', [PenyewaController::class, 'store'])->name('store'); // Menyimpan penyewa baru
    Route::get('/{id}', [PenyewaController::class, 'show'])->name('show'); // Menampilkan detail penyewa
    Route::get('/{id}/edit', [PenyewaController::class, 'edit'])->name('edit'); // Form untuk mengedit penyewa
    Route::put('/{id}', [PenyewaController::class, 'update'])->name('update'); // Mengupdate penyewa
    Route::delete('/{id}', [PenyewaController::class, 'destroy'])->name('destroy'); // Menghapus penyewa
});

//Route::resource('transaksi', TransaksiController::class);
Route::prefix('transaksi')->name('transaksi.')->group(function () {
    Route::get('/', [TransaksiController::class, 'index'])->name('index'); // Menampilkan daftar transaksi
    Route::get('/create', [TransaksiController::class, 'create'])->name('create'); // Form untuk menambahkan transaksi baru
  Route::post('/store', [TransaksiController::class, 'store'])->name('store');
  Route::get('/{id}', [TransaksiController::class, 'show'])->name('show'); // Menampilkan detail transaksi
    
  Route::get('/{id}/edit', [TransaksiController::class, 'edit'])->name('edit'); // Form untuk mengedit transaksi
    Route::put('/{id}', [TransaksiController::class, 'update'])->name('update'); // Mengupdate transaksi
    Route::delete('/{id}', [TransaksiController::class, 'destroy'])->name('destroy'); // Menghapus transaksi
 

});
