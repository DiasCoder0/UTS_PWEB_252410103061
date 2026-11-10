<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

// Halaman utama langsung ke register
Route::get('/', function () {
    return redirect()->route('register');
});

// Register
Route::get('/register', [PageController::class, 'register'])->name('register');
Route::post('/register', [PageController::class, 'prosesRegister'])->name('register.proses');

// Login
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::post('/login', [PageController::class, 'prosesLogin'])->name('login.proses');

// Logout
Route::get('/logout', [PageController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

// Stok Panen
Route::get('/stok-panen', [PageController::class, 'stokPanen'])->name('stok-panen');

// Tambah Barang
Route::get('/tambah-barang', [PageController::class, 'tambahBarang'])->name('tambah-barang');
Route::post('/tambah-barang', [PageController::class, 'prosesTambahBarang'])->name('tambah-barang.proses');

// Distribusi Barang
Route::get('/distribusi', [PageController::class, 'distribusi'])->name('distribusi');
Route::post('/distribusi', [PageController::class, 'prosesDistribusi'])->name('distribusi.proses');

// Konversi Limbah
Route::get('/konversi-limbah', [PageController::class, 'konversiLimbah'])->name('konversi-limbah');

// Profil
Route::get('/profile', [PageController::class, 'profile'])->name('profile');
