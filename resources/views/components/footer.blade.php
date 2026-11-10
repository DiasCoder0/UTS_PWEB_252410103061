<footer class="floss-footer mt-auto">
    <div class="container">
        <div class="row align-items-center py-4">

            {{-- Brand & Tagline --}}
            <div class="col-md-5 mb-3 mb-md-0">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <img src="{{ asset('images/logo.png') }}" alt="FLOSSLOOP Logo" class="footer-logo">
                </div>
                <p class="footer-tagline mb-0">
                    Dari Lahan ke Nilai — Tidak Ada Panen yang Sia-sia.
                </p>
            </div>

            {{-- Navigasi Cepat --}}
            <div class="col-md-3 mb-3 mb-md-0">
                <h6 class="footer-heading">Navigasi</h6>
                <ul class="list-unstyled footer-links mb-0">
                    <li><a href="{{ route('dashboard') }}"><i class="bi bi-chevron-right"></i> Dashboard</a></li>
                    <li><a href="{{ route('stok-panen') }}"><i class="bi bi-chevron-right"></i> Stok Panen</a></li>
                    <li><a href="{{ route('konversi-limbah') }}"><i class="bi bi-chevron-right"></i> Konversi Limbah</a></li>
                    <li><a href="{{ route('profile') }}"><i class="bi bi-chevron-right"></i> Profil</a></li>
                </ul>
            </div>

            {{-- Info Sistem --}}
            <div class="col-md-4 text-md-end">
                <p class="footer-info mb-1">
                    <i class="bi bi-geo-alt me-1"></i> Sistem Manajemen Agroindustri
                </p>
                <p class="footer-info mb-1">
                    <i class="bi bi-leaf me-1"></i> Food Loss Optimization & Sustainability
                </p>
                <p class="footer-info mb-0">
                    <i class="bi bi-arrow-repeat me-1"></i> Zero Waste Agriculture Loop
                </p>
            </div>

        </div>

        <hr class="footer-divider">

        <div class="text-center pb-3">
            <small class="footer-copy">
                &copy; 2026 FLOSSLOOP Agro System
            </small>
        </div>
    </div>
</footer>
