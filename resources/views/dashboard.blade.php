@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-container page-bg-green">
    <div class="container py-4">

        {{-- ================================================ --}}
        {{-- FITUR 2: Alert Login Berhasil (flash message)    --}}
        {{-- ================================================ --}}
        @if (session('login_success'))
        <div class="alert-login d-flex align-items-center gap-3 mb-4" id="loginAlert">
            <span class="alert-login-icon">🌿</span>
            <div>
                <strong>Login berhasil!</strong>
                Selamat datang kembali, <strong>{{ session('login_success') }}</strong>.
                Semoga harimu produktif!
            </div>
            <button class="alert-login-close ms-auto" onclick="tutupAlert()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        @endif

        {{-- Header Sambutan --}}
        <div class="page-header mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="page-icon">
                    <i class="bi bi-speedometer2"></i>
                </div>
                <div>
                    <h4 class="page-title mb-0">Selamat Datang, {{ $username }}! 👋</h4>
                    <p class="page-sub mb-0">Pantau kondisi panen dan konversi limbah hari ini</p>
                </div>
            </div>
        </div>

        {{-- Kartu Statistik --}}
        <div class="row g-3 mb-4">

            <div class="col-sm-6 col-lg-3">
                <div class="stat-card stat-green">
                    <div class="stat-icon"><i class="bi bi-basket2"></i></div>
                    <div class="stat-info">
                        <h3 class="stat-number">{{ $statistik['total_komoditas'] }}</h3>
                        <p class="stat-label">Total Komoditas</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="stat-card stat-brown">
                    <div class="stat-icon"><i class="bi bi-boxes"></i></div>
                    <div class="stat-info">
                        <h3 class="stat-number">{{ $statistik['total_stok_kg'] }} kg</h3>
                        <p class="stat-label">Total Stok Panen</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="stat-card stat-yellow">
                    <div class="stat-icon"><i class="bi bi-exclamation-triangle"></i></div>
                    <div class="stat-info">
                        <h3 class="stat-number">{{ $statistik['perlu_konversi'] }}</h3>
                        <p class="stat-label">Jenis Perlu Konversi</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="stat-card stat-teal">
                    <div class="stat-icon"><i class="bi bi-recycle"></i></div>
                    <div class="stat-info">
                        <h3 class="stat-number">{{ $statistik['produk_konversi'] }}</h3>
                        <p class="stat-label">Produk Konversi</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- ================================================ --}}
        {{-- FITUR 3: Ringkasan Per Kategori                  --}}
        {{-- ================================================ --}}
        <div class="row g-3 mb-4">
            @foreach ($ringkasanKategori as $kat)
            <div class="col-md-6">
                <div class="info-card h-100">
                    <div class="info-card-header">
                        <span class="me-2">{{ $kat['emoji'] }}</span> Ringkasan {{ $kat['kategori'] }}
                        <span class="ms-2 badge-kualitas badge-a" style="float:right">
                            {{ $kat['total_item'] }} komoditas &middot; {{ $kat['total_kg'] }} kg
                        </span>
                    </div>
                    <div class="info-card-body">

                        {{-- Progress Kualitas --}}
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <small class="fw-600">Distribusi Kualitas</small>
                                <small class="text-muted">{{ $kat['persen_sehat'] }}% layak jual</small>
                            </div>
                            <div class="progress-floss">
                                <div class="progress-bar-a" style="width: {{ ($kat['siap_jual'] / $kat['total_item']) * 100 }}%"
                                     title="Kualitas A"></div>
                                <div class="progress-bar-b" style="width: {{ ($kat['layak_jual'] / $kat['total_item']) * 100 }}%"
                                     title="Kualitas B"></div>
                                <div class="progress-bar-c" style="width: {{ ($kat['perlu_konversi'] / $kat['total_item']) * 100 }}%"
                                     title="Kualitas C"></div>
                            </div>
                            <div class="d-flex gap-3 mt-2">
                                <small class="legend-dot legend-a">A — Siap Jual ({{ $kat['siap_jual'] }})</small>
                                <small class="legend-dot legend-b">B — Layak Jual ({{ $kat['layak_jual'] }})</small>
                                <small class="legend-dot legend-c">C — Konversi ({{ $kat['perlu_konversi'] }})</small>
                            </div>
                        </div>

                        {{-- Mini Tabel --}}
                        <div class="mini-table">
                            <div class="mini-table-row">
                                <span>Total Stok</span>
                                <strong>{{ $kat['total_kg'] }} kg</strong>
                            </div>
                            <div class="mini-table-row">
                                <span>Jumlah Komoditas</span>
                                <strong>{{ $kat['total_item'] }} jenis</strong>
                            </div>
                            <div class="mini-table-row">
                                <span>Perlu Dikonversi</span>
                                <strong class="text-danger">{{ $kat['perlu_konversi'] }} jenis</strong>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Tentang Sistem & Alur — dipanggil via @include dari partials --}}
        @include('partials.info-sistem')

    </div>
</div>
@endsection

@section('scripts')
<script>
    // Auto-tutup alert setelah 5 detik
    setTimeout(() => {
        const el = document.getElementById('loginAlert');
        if (el) {
            el.style.transition = 'opacity 0.5s, transform 0.5s';
            el.style.opacity = '0';
            el.style.transform = 'translateY(-10px)';
            setTimeout(() => el.remove(), 500);
        }
    }, 5000);

    function tutupAlert() {
        const el = document.getElementById('loginAlert');
        if (el) {
            el.style.transition = 'opacity 0.3s, transform 0.3s';
            el.style.opacity = '0';
            el.style.transform = 'translateY(-10px)';
            setTimeout(() => el.remove(), 300);
        }
    }
</script>
@endsection
