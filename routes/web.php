<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelolaAdminController;
use App\Http\Controllers\TambahAdminController;
use App\Http\Controllers\KelolaPenggunaController;
use App\Http\Controllers\KelolaPresensiController;
use App\Http\Controllers\TambahRoleController;
use App\Http\Controllers\RoleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//sidebar route
Route::get('/kelola-admin', [KelolaAdminController::class, 'index'])->name('kelola.admin');
Route::get('/kelola-pengguna', [KelolaPenggunaController::class, 'index'])->name('kelola.pengguna');
Route::get('/kelola-presensi', [KelolaPresensiController::class, 'index'])->name('kelola.presensi');

//route kelola admin
Route::get('/tambah-admin', [TambahAdminController::class, 'index'])->name('tambah.admin');
Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');


require __DIR__.'/auth.php';
