# 🌿 FLOSSLOOP — Food Loss Optimization and Sustainability Loop

**UTS Pemrograman Web Genap 2025/2026**
| | |
|---|---|
| **Nama** | Dias Faizullah Parvez |
| **NIM** | 252410103061 |
| **Framework** | Laravel (PHP) |

---

## 📌 Tentang Aplikasi

**FLOSSLOOP** adalah sistem pencatatan hasil panen dan konversi sisa produksi pertanian menjadi produk bernilai guna. Aplikasi ini ditujukan untuk pelaku usaha agroindustri skala kecil dan menengah yang juga mengelola peternakan, membantu mengurangi limbah hasil panen secara terstruktur.

> *Food Loss Optimization & Sustainability — Zero Waste Agriculture Loop*

---

## 🔧 Teknologi

- **Framework:** Laravel (PHP) — Arsitektur MVC
- **Templating:** Blade Engine (`@extends`, `@section`, `@yield`, `@include`, `x-component`)
- **CSS Framework:** Bootstrap 5.3
- **Icons:** Bootstrap Icons
- **Font:** Plus Jakarta Sans

---

## 📸 Screenshot

### Halaman Register
![Register](screenshots/register.png)

### Halaman Login
![Login](screenshots/login.png)

### Dashboard
![Dashboard](screenshots/dashboard.png)

### Dashboard — Bagian Bawah
![Dashboard Bawah](screenshots/dashboard-bawah.png)

### Stok Panen
![Stok Panen](screenshots/stok-panen.png)

### Tambah Barang
![Tambah Barang](screenshots/tambah-barang.png)

### Distribusi Barang
![Distribusi](screenshots/distribusi.png)

### Konversi Limbah
![Konversi](screenshots/konversi.png)

### Profil
![Profil](screenshots/profil.png)

---

## 🌾 Fitur Utama

| Fitur | Keterangan |
|---|---|
| **Register & Login** | Form pendaftaran akun pengelola, data disimpan via session |
| **Dashboard** | Statistik stok, ringkasan per kategori sayur & buah |
| **Stok Panen** | Daftar 12+ komoditas dengan kualitas A/B/C, filter per kualitas |
| **Tambah Barang** | Input komoditas baru ke stok |
| **Distribusi** | Pilih komoditas untuk didistribusikan, stok otomatis berkurang |
| **Konversi Limbah** | Konversi komoditas kualitas C menjadi Pupuk Kompos / Pakan Ternak |
| **Profil** | Data pengelola, username dikirim dari session login |

---

## 🗂️ Alur Kualitas

```
Kualitas A  →  Siap Jual langsung ke pasar
Kualitas B  →  Layak Jual dengan seleksi
Kualitas C  →  Dikonversi menjadi Pupuk Kompos atau Pakan Ternak
```

---

## 🚀 Cara Menjalankan

```bash
# 1. Clone repository
git clone https://github.com/<username>/UTS_PWEB_252410103061.git

# 2. Masuk ke folder project
cd UTS_PWEB_252410103061

# 3. Install dependency
composer install

# 4. Copy file environment
cp .env.example .env

# 5. Generate app key
php artisan key:generate

# 6. Jalankan server
php artisan serve
```

Buka browser: **http://127.0.0.1:8000**

---

## 🗂️ Struktur File Utama

```
├── routes/web.php                          ← Semua routing aplikasi
├── app/Http/Controllers/
│   └── PageController.php                 ← Satu controller semua logika
├── resources/views/
│   ├── layouts/app.blade.php              ← Layout utama
│   ├── components/
│   │   ├── navbar.blade.php               ← Komponen navbar
│   │   └── footer.blade.php              ← Komponen footer
│   ├── partials/
│   │   └── info-sistem.blade.php         ← Partial view (@include)
│   ├── register.blade.php
│   ├── login.blade.php
│   ├── dashboard.blade.php
│   ├── stok-panen.blade.php
│   ├── tambah-barang.blade.php
│   ├── distribusi.blade.php
│   ├── konversi-limbah.blade.php
│   └── profile.blade.php
└── public/
    ├── css/style.css                      ← Custom stylesheet
    └── images/logo.png                   ← Logo FLOSSLOOP
```
