@extends('layouts.app')

@section('title', 'Stok Panen')

@section('content')
<div class="page-container page-bg-green">
    <div class="container py-4">

        {{-- Header Halaman --}}
        <div class="page-header mb-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="page-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div>
                        <h4 class="page-title mb-0">Pengelolaan Stok Panen</h4>
                        <p class="page-sub mb-0">Data komoditas sayur dan buah berdasarkan kualitas panen</p>
                    </div>
                </div>
                <a href="{{ route('tambah-barang') }}" class="btn btn-primary-floss">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Barang
                </a>
            </div>
        </div>

        {{-- Alert sukses tambah barang --}}
        @if (session('sukses_tambah'))
        <div class="alert-login d-flex align-items-center gap-3 mb-4" id="alertTambah">
            <span class="alert-login-icon">✅</span>
            <div>
                <strong>Berhasil!</strong> Komoditas <strong>{{ session('sukses_tambah') }}</strong> berhasil ditambahkan ke stok panen.
            </div>
            <button class="alert-login-close ms-auto" onclick="document.getElementById('alertTambah').remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        @endif

        {{-- ================================================ --}}
        {{-- FITUR 1: Tombol Filter Kualitas                  --}}
        {{-- ================================================ --}}
        <div class="filter-bar mb-4">
            <span class="filter-label"><i class="bi bi-funnel me-1"></i> Filter Kualitas:</span>
            <div class="filter-buttons">
                <button class="btn-filter active" data-filter="semua" onclick="filterKualitas('semua', this)">
                    Semua
                </button>
                <button class="btn-filter btn-filter-a" data-filter="A" onclick="filterKualitas('A', this)">
                    <span class="filter-dot dot-a"></span> Kualitas A — Siap Jual
                </button>
                <button class="btn-filter btn-filter-b" data-filter="B" onclick="filterKualitas('B', this)">
                    <span class="filter-dot dot-b"></span> Kualitas B — Layak Jual
                </button>
                <button class="btn-filter btn-filter-c" data-filter="C" onclick="filterKualitas('C', this)">
                    <span class="filter-dot dot-c"></span> Kualitas C — Perlu Konversi
                </button>
            </div>
        </div>

        {{-- Tabel Stok Panen --}}
        <div class="table-card">
            <div class="table-card-header d-flex align-items-center justify-content-between">
                <span><i class="bi bi-table me-2"></i> Daftar Stok Panen</span>
                <span class="badge bg-secondary" id="jumlahTampil">{{ count($stokPanen) }} komoditas</span>
            </div>
            <div class="table-responsive">
                <table class="table floss-table mb-0" id="tabelStok">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Komoditas</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Kualitas</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Loop data stok panen dari controller --}}
                        @foreach ($stokPanen as $item)
                        <tr class="baris-stok" data-kualitas="{{ $item['kualitas'] }}">
                            <td class="text-muted">{{ $item['id'] }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if ($item['kategori'] === 'Sayur')
                                        <span class="komoditas-icon sayur">🥦</span>
                                    @else
                                        <span class="komoditas-icon buah">🍎</span>
                                    @endif
                                    <strong>{{ $item['komoditas'] }}</strong>
                                </div>
                            </td>
                            <td>
                                <span class="kategori-badge {{ $item['kategori'] === 'Sayur' ? 'kategori-sayur' : 'kategori-buah' }}">
                                    {{ $item['kategori'] }}
                                </span>
                            </td>
                            <td><strong>{{ $item['jumlah'] }}</strong> {{ $item['satuan'] }}</td>
                            <td>
                                <span class="kualitas-badge kualitas-{{ strtolower($item['kualitas']) }}">
                                    {{ $item['kualitas'] }}
                                </span>
                            </td>
                            <td>
                                <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $item['status'])) }}">
                                    @if ($item['status'] === 'Siap Jual')
                                        <i class="bi bi-check-circle me-1"></i>
                                    @elseif ($item['status'] === 'Layak Jual')
                                        <i class="bi bi-dash-circle me-1"></i>
                                    @else
                                        <i class="bi bi-exclamation-circle me-1"></i>
                                    @endif
                                    {{ $item['status'] }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pesan jika tidak ada data --}}
                <div id="pesanKosong" class="text-center py-4 d-none">
                    <span style="font-size:2rem">🔍</span>
                    <p class="text-muted mt-2">Tidak ada komoditas dengan kualitas ini.</p>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    // Fungsi filter berdasarkan kualitas
    function filterKualitas(kualitas, tombol) {

        // Update tampilan tombol aktif
        document.querySelectorAll('.btn-filter').forEach(btn => btn.classList.remove('active'));
        tombol.classList.add('active');

        // Tampilkan/sembunyikan baris tabel
        const semuaBaris = document.querySelectorAll('.baris-stok');
        let jumlahTampil = 0;

        semuaBaris.forEach(baris => {
            if (kualitas === 'semua' || baris.dataset.kualitas === kualitas) {
                baris.style.display = '';
                jumlahTampil++;
            } else {
                baris.style.display = 'none';
            }
        });

        // Update counter
        document.getElementById('jumlahTampil').textContent = jumlahTampil + ' komoditas';

        // Tampilkan pesan kosong jika tidak ada data
        const pesanKosong = document.getElementById('pesanKosong');
        if (jumlahTampil === 0) {
            pesanKosong.classList.remove('d-none');
        } else {
            pesanKosong.classList.add('d-none');
        }
    }
</script>
@endsection
