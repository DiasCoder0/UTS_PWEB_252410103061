@extends('layouts.app')

@section('title', 'Konversi Limbah')

@section('content')
<div class="page-container page-bg-green">
    <div class="container py-4">

        {{-- Header Halaman --}}
        <div class="page-header mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="page-icon">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
                <div>
                    <h4 class="page-title mb-0">Konversi Limbah Panen</h4>
                    <p class="page-sub mb-0">Pengolahan komoditas kualitas C menjadi produk bernilai guna</p>
                </div>
            </div>
        </div>

        {{-- Keterangan Singkat --}}
        <div class="info-banner mb-4">
            <i class="bi bi-lightbulb me-2"></i>
            Komoditas dengan <strong>Kualitas C</strong> (tidak layak jual) dikonversi menjadi
            <strong>Pupuk Kompos</strong> atau <strong>Pakan Ternak</strong> — mendukung sistem
            pertanian sirkular tanpa limbah.
        </div>

        {{-- List Konversi --}}
        <div class="row g-3">
            {{-- Loop data konversi limbah dari controller --}}
            @foreach ($konversiLimbah as $item)
            <div class="col-md-6">
                <div class="konversi-card">

                    {{-- Header Card --}}
                    <div class="konversi-card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-2">
                                <span class="konversi-id">#{{ $item['id'] }}</span>
                                <strong>{{ $item['asal_komoditas'] }}</strong>
                                <span class="kategori-badge {{ $item['kategori'] === 'Sayur' ? 'kategori-sayur' : 'kategori-buah' }}">
                                    {{ $item['kategori'] }}
                                </span>
                            </div>
                            <span class="produk-badge {{ $item['hasil_produk'] === 'Pakan Ternak' ? 'produk-pakan' : 'produk-pupuk' }}">
                                @if ($item['hasil_produk'] === 'Pakan Ternak')
                                    <i class="bi bi-egg me-1"></i>
                                @else
                                    <i class="bi bi-flower3 me-1"></i>
                                @endif
                                {{ $item['hasil_produk'] }}
                            </span>
                        </div>
                    </div>

                    {{-- Body Card --}}
                    <div class="konversi-card-body">

                        {{-- Baris info --}}
                        <div class="konversi-info-row">
                            <span class="konversi-label"><i class="bi bi-box me-1"></i> Stok Masuk</span>
                            <span class="konversi-value">{{ $item['jumlah_masuk'] }} {{ $item['satuan'] }}</span>
                        </div>

                        <div class="konversi-info-row">
                            <span class="konversi-label"><i class="bi bi-percent me-1"></i> Persentase Konversi</span>
                            <span class="konversi-value">{{ $item['persentase_konversi'] }}%</span>
                        </div>

                        <div class="konversi-info-row highlight">
                            <span class="konversi-label"><i class="bi bi-arrow-right-circle me-1"></i> Hasil Konversi</span>
                            <span class="konversi-value"><strong>{{ $item['jumlah_konversi'] }} {{ $item['satuan'] }}</strong></span>
                        </div>

                        <div class="konversi-info-row">
                            <span class="konversi-label"><i class="bi bi-gear me-1"></i> Metode</span>
                            <span class="konversi-value">{{ $item['jenis_konversi'] }}</span>
                        </div>

                        {{-- Manfaat --}}
                        <div class="konversi-manfaat mt-2">
                            <i class="bi bi-check2-circle me-1"></i> {{ $item['manfaat'] }}
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>
@endsection
