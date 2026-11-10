<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FLOSSLOOP - Daftar Akun</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="auth-body">

<div class="auth-split-wrapper">

    {{-- SISI KIRI — Panel Hijau --}}
    <div class="auth-panel-left">

        {{-- Dekorasi bulatan --}}
        <div class="panel-deco panel-deco-1"></div>
        <div class="panel-deco panel-deco-2"></div>
        <div class="panel-deco panel-deco-3"></div>

        <div class="panel-content">
            <img src="{{ asset('images/logo.png') }}" alt="FLOSSLOOP" class="panel-logo">

            <h2 class="panel-title">FLOSSLOOP</h2>
            <p class="panel-slogan">Food Loss Optimization<br>& Sustainability</p>
            <p class="panel-sub">Zero Waste Agriculture Loop</p>

            <div class="panel-divider"></div>

            <div class="panel-features">
                <div class="panel-feature-item">
                    <span class="panel-feature-icon">🌾</span>
                    <span>Kelola hasil panen dengan mudah</span>
                </div>
                <div class="panel-feature-item">
                    <span class="panel-feature-icon">📊</span>
                    <span>Pantau kualitas & stok komoditas</span>
                </div>
                <div class="panel-feature-item">
                    <span class="panel-feature-icon">🌱</span>
                    <span>Dukung pertanian berkelanjutan</span>
                </div>
            </div>
        </div>

    </div>

    {{-- SISI KANAN — Form Register --}}
    <div class="auth-panel-right auth-panel-right-scroll">
        <div class="auth-form-wrapper">

            <div class="auth-form-header">
                <h4 class="auth-form-title">Buat Akun Baru 🌿</h4>
                <p class="auth-form-sub">Daftarkan diri sebagai pengelola FLOSSLOOP</p>
            </div>

            <form action="{{ route('register.proses') }}" method="POST" class="auth-form">
                @csrf

                <div class="mb-3">
                    <label class="form-label-floss">Nama Lengkap</label>
                    <div class="input-group auth-input-group">
                        <span class="input-group-text auth-input-icon"><i class="bi bi-person"></i></span>
                        <input type="text" name="nama" class="form-control auth-input"
                               placeholder="Masukkan nama lengkap" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label-floss">Username</label>
                    <div class="input-group auth-input-group">
                        <span class="input-group-text auth-input-icon"><i class="bi bi-at"></i></span>
                        <input type="text" name="username" class="form-control auth-input"
                               placeholder="Buat username" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label-floss">Password</label>
                    <div class="input-group auth-input-group">
                        <span class="input-group-text auth-input-icon"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control auth-input"
                               placeholder="Buat password" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label-floss">Nomor Karyawan</label>
                    <div class="input-group auth-input-group">
                        <span class="input-group-text auth-input-icon"><i class="bi bi-badge-id"></i></span>
                        <input type="text" name="no_karyawan" class="form-control auth-input"
                               placeholder="Contoh: KRY-2024-001" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label-floss">Jabatan</label>
                    <div class="input-group auth-input-group">
                        <span class="input-group-text auth-input-icon"><i class="bi bi-briefcase"></i></span>
                        <select name="jabatan" class="form-select auth-input" required>
                            <option value="" disabled selected>Pilih jabatan</option>
                            <option value="Pengelola Usaha Tani">Pengelola Usaha Tani</option>
                            <option value="Supervisor Panen">Supervisor Panen</option>
                            <option value="Operator Konversi">Operator Konversi</option>
                            <option value="Admin Gudang">Admin Gudang</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label-floss">Tanggal Mulai Kerja</label>
                    <div class="input-group auth-input-group">
                        <span class="input-group-text auth-input-icon"><i class="bi bi-calendar3"></i></span>
                        <input type="date" name="mulai_kerja" class="form-control auth-input" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-auth w-100">
                    <i class="bi bi-person-plus me-2"></i> Daftar Sekarang
                </button>

            </form>

            <div class="auth-form-footer">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="auth-link">Masuk di sini</a>
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
