<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::any('/', [LoginController::class, 'login'])->name('login');
Route::any('/proses_login', [LoginController::class, 'prosesLogin'])->name('prosesLogin');
Route::any('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->middleware(['admin'])->group(function () {
        Route::any('/home', [AdminController::class, 'index'])->name('admin.index');
        Route::any('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::any('/update_profile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
        Route::any('/instansi', [AdminController::class, 'instansi'])->name('admin.instansi');
        Route::any('/add_instansi', [AdminController::class, 'addInstansi'])->name('admin.addInstansi');
        Route::any('/update_instansi', [AdminController::class, 'updateInstansi'])->name('admin.updateInstansi');
        Route::any('/delete_instansi/{id}', [AdminController::class, 'deleteInstansi'])->name('admin.deleteInstansi');
        Route::any('/user', [AdminController::class, 'user'])->name('admin.user');
        Route::any('/add_user', [AdminController::class, 'addUser'])->name('admin.addUser');
        Route::any('/update_user', [AdminController::class, 'updateUser'])->name('admin.updateUser');
        Route::any('/delete_user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
        Route::any('/kegiatan', [AdminController::class, 'kegiatan'])->name('admin.kegiatan');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('user')->middleware(['user'])->group(function () {
        Route::any('/home', [UserController::class, 'index'])->name('user.index');
        Route::any('/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::any('/update_profile', [UserController::class, 'updateProfile'])->name('user.updateProfile');
        Route::any('/penegakan_hukum', [UserController::class, 'penegakan_hukum'])->name('user.penegakan_hukum');
        Route::any('/pendampingan_hukum', [UserController::class, 'pendampingan_hukum'])->name('user.pendampingan_hukum');
        Route::any('/bantuan_hukum_litigasi', [UserController::class, 'bantuan_hukum_litigasi'])->name('user.bantuan_hukum_litigasi');
        Route::any('/bantuan_hukum_non_litigasi', [UserController::class, 'bantuan_hukum_non_litigasi'])->name('user.bantuan_hukum_non_litigasi');
        Route::any('/pendapat_hukum', [UserController::class, 'pendapat_hukum'])->name('user.pendapat_hukum');
        Route::any('/pelayanan_hukum', [UserController::class, 'pelayanan_hukum'])->name('user.pelayanan_hukum');
        Route::any('/audit_hukum', [UserController::class, 'audit_hukum'])->name('user.audit_hukum');
        Route::any('/bantuan_hukum_lainnya', [UserController::class, 'bantuan_hukum_lainnya'])->name('user.bantuan_hukum_lainnya');
        Route::any('/perjanjian_kerjasama', [UserController::class, 'perjanjian_kerjasama'])->name('user.perjanjian_kerjasama');
        Route::any('/detail_kegiatan/{id}', [UserController::class, 'detail_kegiatan'])->name('user.detail_kegiatan');
        Route::any('/delete_kegiatan/{id}', [UserController::class, 'delete_kegiatan'])->name('user.delete_kegiatan');
        Route::any('/add_kegiatan', [UserController::class, 'add_kegiatan'])->name('user.add_kegiatan');
        Route::any('/update_kegiatan', [UserController::class, 'update_kegiatan'])->name('user.update_kegiatan');
        Route::any('/laporan_kegiatan', [UserController::class, 'laporanKegiatan'])->name('user.laporanKegiatan');
    });
});
