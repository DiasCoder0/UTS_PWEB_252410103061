@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
<div class="page-container page-bg-brown">
    <div class="container py-4">

        {{-- Header --}}
        <div class="page-header mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="page-icon">
                    <i class="bi bi-plus-circle"></i>
                </div>
                <div>
                    <h4 class="page-title mb-0">Tambah Barang Panen</h4>
                    <p class="page-sub mb-0">Input komoditas baru ke dalam sistem stok panen</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-7">

                <div class="form-card">
                    <div class="form-card-header">
                        <i class="bi bi-clipboard-plus me-2"></i> Form Input Barang
                    </div>
                    <div class="form-card-body">

                        <form action="{{ route('tambah-barang.proses') }}" method="POST">
                            @csrf

                            {{-- Nama Komoditas --}}
                            <div class="mb-4">
                                <label class="form-label-floss">
                                    <i class="bi bi-tag me-1"></i> Nama Komoditas
                                </label>
                                <input type="text" name="komoditas" class="form-control form-control-floss"
                                       placeholder="Contoh: Brokoli, Alpukat, Stroberi..." required>
                            </div>

                            {{-- Kategori & Kualitas --}}
                            <div class="row g-3 mb-4">
                                <div class="col-sm-6">
                                    <label class="form-label-floss">
                                        <i class="bi bi-grid me-1"></i> Kategori
                                    </label>
                                    <div class="radio-group">
                                        <label class="radio-option">
                                            <input type="radio" name="kategori" value="Sayur" required>
                                            <span class="radio-box">🥦 Sayur</span>
                                        </label>
                                        <label class="radio-option">
                                            <input type="radio" name="kategori" value="Buah">
                                            <span class="radio-box">🍎 Buah</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label-floss">
                                        <i class="bi bi-star me-1"></i> Kualitas
                                    </label>
                                    <div class="radio-group">
                                        <label class="radio-option">
                                            <input type="radio" name="kualitas" value="A" required>
                                            <span class="radio-box kualitas-radio-a">A — Siap Jual</span>
                                        </label>
                                        <label class="radio-option">
                                            <input type="radio" name="kualitas" value="B">
                                            <span class="radio-box kualitas-radio-b">B — Layak Jual</span>
                                        </label>
                                        <label class="radio-option">
                                            <input type="radio" name="kualitas" value="C">
                                            <span class="radio-box kualitas-radio-c">C — Perlu Konversi</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- Jumlah --}}
                            <div class="mb-4">
                                <label class="form-label-floss">
                                    <i class="bi bi-weight me-1"></i> Jumlah (kg)
                                </label>
                                <div class="input-jumlah-wrap">
                                    <input type="number" name="jumlah" class="form-control form-control-floss"
                                           placeholder="0" min="1" required>
                                    <span class="input-satuan">kg</span>
                                </div>
                            </div>

                            {{-- Tombol --}}
                            <div class="d-flex gap-3">
                                <button type="submit" class="btn btn-submit-floss flex-grow-1">
                                    <i class="bi bi-plus-circle me-2"></i> Tambahkan ke Stok
                                </button>
                                <a href="{{ route('stok-panen') }}" class="btn btn-batal-floss">
                                    <i class="bi bi-arrow-left me-1"></i> Batal
                                </a>
                            </div>

                        </form>

                    </div>
                </div>

                {{-- Info --}}
                <div class="info-note mt-3">
                    <i class="bi bi-info-circle me-2"></i>
                    Barang yang ditambahkan akan langsung muncul di halaman
                    <a href="{{ route('stok-panen') }}">Stok Panen</a> dan bisa didistribusikan.
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
