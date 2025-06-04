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
use App\Http\Controllers\EditPresensiController;
use App\Http\Controllers\TambahPresensiController;
use App\Http\Controllers\ProfilController;
use App\Exports\AdminsExport;
use App\Exports\UsersExport;
use App\Exports\PresensiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\ProfilUserController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ScheduleController;

//route export excel
Route::get('/admin/unduh', function () {
    return Excel::download(new AdminsExport, 'data_admin.xlsx');
})->name('unduh.admin');
Route::get('/user/unduh', function () {
    return Excel::download(new UsersExport, "data_user.xlsx");
})->name('unduh.user');
Route::get('/export-presensi', function () {
    return Excel::download(new PresensiExport, 'data_presensi.xlsx');
})->name('unduh.presensi');


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // Admin dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // User dashboard
    Route::get('/users/dashboardUser', function () {
        return view('users.dashboardUser');
    })->name('dashboard.user');
});

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
Route::delete('/kelola-presensi/{id}', [KelolaPresensiController::class, 'hapus'])->name('hapus.presensi');
Route::put('/presensi/{id}', [EditPresensiController::class, 'update'])->name('update.presensi');
Route::get('/presensi/{id}/edit', [EditPresensiController::class, 'edit'])->name('edit.presensi');

//profil
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

//Sidebar User
Route::get('/dahsboard-user', function () {
    return view('users.dashboardUser');
})->name('dashboard.user');
Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi');
Route::get('/workspace', [WorkspaceController::class, 'index'])->name('workspace');
Route::get('/profil-user', [ProfilUserController::class, 'index'])->name('profil.user');
Route::get('/board', [BoardController::class, 'index'])->name('board');

//Atur presensi
Route::post('/atur-presensi', [ScheduleController::class, 'store'])->name('atur.presensi');
// generate QR dinamis
Route::get('/generate-qr/{id}', [PresensiController::class, 'generateQr']);
// ketika QR discan
Route::get('/presensi/token/{token}', [PresensiController::class, 'scanQr'])->name('presensi.scan');
Route::get('/presensi/scan', function () {
    return view('users.scan');
})->name('presensi.scan.page');

//workspace
Route::post('/workspace', [WorkspaceController::class, 'store'])->name('workspace.store');
Route::post('/workspace/{id}/copy', [WorkspaceController::class, 'copy'])->name('workspace.copy');
Route::delete('/workspace/{id}', [WorkspaceController::class, 'destroy'])->name('workspace.destroy');
Route::put('/workspace/{id}/archive', [WorkspaceController::class, 'archive'])->name('workspace.archive');
Route::get('/workspace/archived', [WorkspaceController::class, 'archived'])->name('workspace.archived');
Route::put('/workspace/{id}/rename', [WorkspaceController::class, 'rename'])->name('workspace.rename');
Route::put('/workspace/{id}/unarchive', [WorkspaceController::class, 'unarchive'])->name('workspace.unarchive');


require __DIR__.'/auth.php';
