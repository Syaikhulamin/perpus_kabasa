<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
Route::post('/buku/store', [BukuController::class, 'store'])->name('buku.store');
Route::post('/buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');
Route::post('/buku/destroy/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
Route::get('/anggota/edit/{id}', [AnggotaController::class, 'edit'])->name('anggota.edit');
Route::post('/anggota/store', [AnggotaController::class, 'store'])->name('anggota.store');
Route::post('/anggota/update/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
Route::post('/anggota/destroy/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');

Route::get('/peminjamanadasdadadadasdasda', [PeminjamanController::class, 'index'])->name('peminjaman.index');