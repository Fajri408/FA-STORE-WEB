<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;
use App\Models\Produk;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🔐 Redirect root ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// 🔁 Redirect setelah login berdasarkan role
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🛠️ Dashboard Admin
Route::get('/admin', [ProdukController::class, 'adminDashboard'])
    ->middleware(['auth', 'check.role:admin'])
    ->name('admin.dashboard');

// 🏠 Halaman Home untuk User
Route::get('/home', function () {
    $produks = Produk::with('kategori')->latest()->get();
    return view('home', compact('produks'));
})->middleware(['auth'])->name('home');

// 📦 Produk - hanya admin
Route::resource('produk', ProdukController::class)->middleware(['auth', 'check.role:admin']);

// 🏷️ Kategori - hanya admin
Route::resource('kategori', KategoriController::class)->middleware(['auth', 'check.role:admin']);

// 👤 Profile (standar dari Breeze)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🛡️ Breeze Auth (login, register, password reset, dll)
require __DIR__.'/auth.php';
