<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelolaAdminController;
use App\Http\Controllers\TambahAdminController;
use App\Http\Controllers\KelolaPenggunaController;
use App\Http\Controllers\KelolaPresensiController;
use App\Http\Controllers\TambahRoleController;
use App\Http\Controllers\TambahPenggunaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EditAdminController;
use App\Http\Controllers\EditPenggunaController;
use App\Http\Controllers\TambahPresensiController;

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
Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
Route::get('/tambah-admin', [TambahAdminController::class, 'index'])->name('tambah.admin');
Route::post('/tambah-admin', [TambahAdminController::class, 'store'])->name('tambah.admin.store');
Route::get('/kelola-admin', [KelolaAdminController::class, 'index'])->name('kelola.admin');
Route::delete('/kelola-admin/{id}', [KelolaAdminController::class, 'hapus'])->name('hapus.admin');
Route::get('/admin/{id}/edit', [EditAdminController::class, 'edit'])->name('edit.admin');
Route::put('/admin/{id}', [EditAdminController::class, 'update'])->name('update.admin');
Route::get('/admin', [EditAdminController::class, 'index'])->name('kelola.admin');

//route kelola pengguna
Route::delete('/kelola-pengguna/{id}', [KelolaPenggunaController::class, 'hapus'])->name('hapus.pengguna');
Route::get('/tambah-pengguna', [TambahPenggunaController::class, 'index'])->name('tambah.pengguna');
Route::post('/tambah-pengguna', [TambahpenggunaController::class, 'store'])->name('tambah.pengguna.store');
Route::get('/user/{id}/edit', [EditPenggunaController::class, 'edit'])->name('edit.pengguna');
Route::put('/user/{id}', [EditPenggunaController::class, 'update'])->name('update.pengguna');
Route::get('/user', [EditPenggunaController::class, 'index'])->name('kelola.pengguna');

//route kelola presensi
Route::get('/kelola-presensi', [KelolaPresensiController::class, 'index'])->name('kelola.presensi');
Route::get('/tambah-presensi', [TambahPresensiController::class, 'index'])->name('tambah.presensi');
Route::post('/tambah-presensi', [TambahPresensiController::class, 'store'])->name('tambah.presensi.store');
require __DIR__.'/auth.php';
