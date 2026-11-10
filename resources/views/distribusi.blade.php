@extends('layouts.app')

@section('title', 'Distribusi Barang')

@section('content')
<div class="page-container page-bg-teal">
    <div class="container py-4">

        {{-- Header --}}
        <div class="page-header mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="page-icon">
                    <i class="bi bi-send"></i>
                </div>
                <div>
                    <h4 class="page-title mb-0">Distribusi Barang</h4>
                    <p class="page-sub mb-0">Pilih komoditas untuk didistribusikan — stok akan otomatis berkurang</p>
                </div>
            </div>
        </div>

        {{-- Alert sukses --}}
        @if (session('sukses_distribusi'))
        <div class="alert-login d-flex align-items-center gap-3 mb-4" id="alertDist">
            <span class="alert-login-icon">🚚</span>
            <div>
                <strong>Distribusi berhasil!</strong>
                Komoditas <strong>{{ session('sukses_distribusi') }}</strong> telah berhasil didistribusikan.
            </div>
            <button class="alert-login-close ms-auto" onclick="document.getElementById('alertDist').remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        @endif

        {{-- Alert error --}}
        @if (session('error_distribusi'))
        <div class="alert-error d-flex align-items-center gap-3 mb-4" id="alertErr">
            <span class="alert-login-icon">⚠️</span>
            <div>{{ session('error_distribusi') }}</div>
            <button class="alert-login-close ms-auto" onclick="document.getElementById('alertErr').remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        @endif

        <div class="row g-4">

            {{-- Form Distribusi --}}
            <div class="col-lg-5">
                <div class="form-card h-100">
                    <div class="form-card-header">
                        <i class="bi bi-box-arrow-right me-2"></i> Form Distribusi
                    </div>
                    <div class="form-card-body">

                        <form action="{{ route('distribusi.proses') }}" method="POST">
                            @csrf

                            {{-- Pilih Barang --}}
                            <div class="mb-4">
                                <label class="form-label-floss">
                                    <i class="bi bi-basket me-1"></i> Pilih Komoditas
                                </label>
                                <select name="id_barang" class="form-select form-control-floss"
                                        required onchange="updateStokInfo(this)">
                                    <option value="" disabled selected>— Pilih komoditas —</option>
                                    @foreach ($stokTersedia as $item)
                                    <option value="{{ $item['id'] }}"
                                            data-stok="{{ $item['jumlah'] }}"
                                            data-kualitas="{{ $item['kualitas'] }}"
                                            data-kategori="{{ $item['kategori'] }}">
                                        {{ $item['komoditas'] }} ({{ $item['kategori'] }}) — Stok: {{ $item['jumlah'] }} kg
                                    </option>
                                    @endforeach
                                </select>

                                {{-- Info stok terpilih --}}
                                <div id="infoStok" class="stok-info mt-2 d-none">
                                    <span id="infoStokText"></span>
                                </div>
                            </div>

                            {{-- Jumlah Distribusi --}}
                            <div class="mb-4">
                                <label class="form-label-floss">
                                    <i class="bi bi-weight me-1"></i> Jumlah Distribusi (kg)
                                </label>
                                <div class="input-jumlah-wrap">
                                    <input type="number" name="jumlah_distribusi" id="inputJumlah"
                                           class="form-control form-control-floss"
                                           placeholder="0" min="1" required>
                                    <span class="input-satuan">kg</span>
                                </div>
                            </div>

                            {{-- Tujuan Distribusi --}}
                            <div class="mb-4">
                                <label class="form-label-floss">
                                    <i class="bi bi-geo-alt me-1"></i> Tujuan Distribusi
                                </label>
                                <select name="tujuan" class="form-select form-control-floss" required>
                                    <option value="" disabled selected>— Pilih tujuan —</option>
                                    <option value="Pasar Tradisional">Pasar Tradisional</option>
                                    <option value="Supermarket">Supermarket</option>
                                    <option value="Restoran / Katering">Restoran / Katering</option>
                                    <option value="Ekspor">Ekspor</option>
                                    <option value="Gudang Penyimpanan">Gudang Penyimpanan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            {{-- Keterangan --}}
                            <div class="mb-4">
                                <label class="form-label-floss">
                                    <i class="bi bi-chat-left-text me-1"></i> Keterangan <small class="text-muted">(opsional)</small>
                                </label>
                                <textarea name="keterangan" class="form-control form-control-floss"
                                          rows="2" placeholder="Catatan tambahan..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-submit-floss w-100">
                                <i class="bi bi-send me-2"></i> Proses Distribusi
                            </button>

                        </form>

                    </div>
                </div>
            </div>

            {{-- Riwayat Distribusi --}}
            <div class="col-lg-7">
                <div class="table-card h-100">
                    <div class="table-card-header d-flex align-items-center justify-content-between">
                        <span><i class="bi bi-clock-history me-2"></i> Riwayat Distribusi</span>
                        <span class="badge bg-secondary">{{ count($riwayatDistribusi) }} transaksi</span>
                    </div>

                    @if (count($riwayatDistribusi) === 0)
                    <div class="text-center py-5">
                        <span style="font-size:2.5rem">🚚</span>
                        <p class="text-muted mt-2 mb-0">Belum ada distribusi yang tercatat.</p>
                        <small class="text-muted">Distribusi pertama akan muncul di sini.</small>
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table floss-table mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Komoditas</th>
                                    <th>Jumlah</th>
                                    <th>Tujuan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Loop riwayat distribusi dari session --}}
                                @foreach ($riwayatDistribusi as $dist)
                                <tr>
                                    <td class="text-muted">{{ $dist['id'] }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="komoditas-icon {{ $dist['kategori'] === 'Sayur' ? 'sayur' : 'buah' }}">
                                                {{ $dist['kategori'] === 'Sayur' ? '🥦' : '🍎' }}
                                            </span>
                                            <strong>{{ $dist['komoditas'] }}</strong>
                                        </div>
                                    </td>
                                    <td><strong>{{ $dist['jumlah_distribusi'] }}</strong> kg</td>
                                    <td>
                                        <span class="kategori-badge kategori-sayur">
                                            {{ $dist['tujuan'] }}
                                        </span>
                                    </td>
                                    <td class="text-muted">{{ $dist['tanggal'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                </div>
            </div>

        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    // Tampilkan info stok saat pilih komoditas
    function updateStokInfo(select) {
        const option   = select.options[select.selectedIndex];
        const stok     = option.dataset.stok;
        const kualitas = option.dataset.kualitas;
        const infoBox  = document.getElementById('infoStok');
        const infoText = document.getElementById('infoStokText');
        const input    = document.getElementById('inputJumlah');

        if (stok !== undefined) {
            infoText.innerHTML = `Stok tersedia: <strong>${stok} kg</strong> &middot; Kualitas <strong>${kualitas}</strong>`;
            infoBox.classList.remove('d-none');
            input.max = stok;
        }
    }
</script>
@endsection
