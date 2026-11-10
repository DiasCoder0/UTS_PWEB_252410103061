{{--
    Partial View: info-sistem.blade.php
    Digunakan di: dashboard.blade.php via @include
    Berisi: penjelasan singkat tentang FLOSSLOOP dan alur kualitas
--}}
<div class="row g-3">

    <div class="col-lg-7">
        <div class="info-card h-100">
            <div class="info-card-header">
                <i class="bi bi-info-circle me-2"></i> Tentang FLOSSLOOP
            </div>
            <div class="info-card-body">
                <p>
                    <strong>FLOSSLOOP</strong> (Food Loss Optimization and Sustainability Loop)
                    adalah sistem pencatatan hasil panen dan konversi sisa produksi pertanian
                    menjadi produk bernilai guna.
                </p>
                <p class="mb-2">Sistem ini dirancang untuk industri kecil dan menengah yang
                    bergerak di bidang pertanian dan peternakan, membantu mengurangi
                    limbah hasil panen secara terstruktur.</p>
                <div class="d-flex gap-2 flex-wrap mt-3">
                    <a href="{{ route('stok-panen') }}" class="btn btn-sm btn-primary-floss">
                        <i class="bi bi-box-seam me-1"></i> Lihat Stok Panen
                    </a>
                    <a href="{{ route('konversi-limbah') }}" class="btn btn-sm btn-secondary-floss">
                        <i class="bi bi-arrow-repeat me-1"></i> Lihat Konversi Limbah
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="info-card h-100">
            <div class="info-card-header">
                <i class="bi bi-diagram-3 me-2"></i> Alur Sistem
            </div>
            <div class="info-card-body">
                <ul class="flow-list">
                    <li>
                        <div class="flow-badge flow-a">A</div>
                        <div>
                            <strong>Kualitas A</strong>
                            <small class="d-block text-muted">Siap langsung dijual ke pasar</small>
                        </div>
                    </li>
                    <li>
                        <div class="flow-badge flow-b">B</div>
                        <div>
                            <strong>Kualitas B</strong>
                            <small class="d-block text-muted">Layak dijual dengan seleksi</small>
                        </div>
                    </li>
                    <li>
                        <div class="flow-badge flow-c">C</div>
                        <div>
                            <strong>Kualitas C</strong>
                            <small class="d-block text-muted">Dikonversi jadi pupuk / pakan</small>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
