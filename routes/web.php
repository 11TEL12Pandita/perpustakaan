<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;

// Route untuk Login & Register
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'prosesLogin'])->name('prosesLogin');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'prosesRegister'])->name('prosesRegister');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk Dashboard
Route::get('/dashboard', function () {
    if (session('user_type') === 'admin') {
        return redirect()->route('admin.dashboard');
    } else if (session('user_type') === 'siswa') {
        return redirect()->route('siswa.dashboard');
    }
    return redirect()->route('login');
})->name('dashboard');

Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/siswa/dashboard', [DashboardController::class, 'siswaDashboard'])->name('siswa.dashboard');
// Route untuk melihat daftar anggota (user dengan role 'siswa')
Route::get('/admin/anggota', [DashboardController::class, 'membersList'])->name('admin.anggota');
Route::get('/admin/anggota/create', [DashboardController::class, 'createMember'])->name('admin.anggota.create');
Route::post('/admin/anggota/store', [DashboardController::class, 'storeMember'])->name('admin.anggota.store');
Route::get('/admin/anggota/edit/{id}', [DashboardController::class, 'editMember'])->name('admin.anggota.edit');
Route::post('/admin/anggota/update/{id}', [DashboardController::class, 'updateMember'])->name('admin.anggota.update');
Route::get('/admin/anggota/delete/{id}', [DashboardController::class, 'deleteMember'])->name('admin.anggota.delete');

// Route untuk Buku
Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
Route::post('/buku/store', [BukuController::class, 'store'])->name('buku.store');
Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
Route::post('/buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');
Route::get('/buku/delete/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

// Route untuk Transaksi
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::put('/transaksi/kembali/{id}', [TransaksiController::class, 'kembali'])->name('transaksi.kembali');
