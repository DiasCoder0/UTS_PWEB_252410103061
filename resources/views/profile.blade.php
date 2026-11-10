@extends('layouts.app')

@section('title', 'Profil Pengguna')

@section('content')
<div class="page-container page-bg-brown">
    <div class="container py-4">

        {{-- Header Halaman --}}
        <div class="page-header mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="page-icon">
                    <i class="bi bi-person-circle"></i>
                </div>
                <div>
                    <h4 class="page-title mb-0">Profil Pengelola</h4>
                    <p class="page-sub mb-0">Informasi akun dan identitas pengguna sistem</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-7">

                {{-- Card Profil --}}
                <div class="profile-card">

                    {{-- Avatar & Nama --}}
                    <div class="profile-hero text-center">
                        <div class="profile-avatar">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        {{-- Username dikirim dari controller (berasal dari form login) --}}
                        <h5 class="profile-name mt-3">{{ $profil['nama'] }}</h5>
                        <span class="profile-role-badge">{{ $profil['jabatan'] }}</span>
                    </div>

                    {{-- Detail Info --}}
                    <div class="profile-details">

                        <div class="profile-row">
                            <div class="profile-row-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="profile-row-content">
                                <small class="profile-row-label">Nama Lengkap</small>
                                <span class="profile-row-value">{{ $profil['nama'] }}</span>
                            </div>
                        </div>

                        <div class="profile-row">
                            <div class="profile-row-icon">
                                <i class="bi bi-at"></i>
                            </div>
                            <div class="profile-row-content">
                                <small class="profile-row-label">Username</small>
                                {{-- Data username dikirim dari sesi login via controller --}}
                                <span class="profile-row-value">{{ $profil['username'] }}</span>
                            </div>
                        </div>

                        <div class="profile-row">
                            <div class="profile-row-icon">
                                <i class="bi bi-badge-id"></i>
                            </div>
                            <div class="profile-row-content">
                                <small class="profile-row-label">Nomor Karyawan</small>
                                <span class="profile-row-value">{{ $profil['no_karyawan'] }}</span>
                            </div>
                        </div>

                        <div class="profile-row">
                            <div class="profile-row-icon">
                                <i class="bi bi-briefcase"></i>
                            </div>
                            <div class="profile-row-content">
                                <small class="profile-row-label">Jabatan / Role</small>
                                <span class="profile-row-value">{{ $profil['jabatan'] }}</span>
                            </div>
                        </div>

                        <div class="profile-row">
                            <div class="profile-row-icon">
                                <i class="bi bi-calendar3"></i>
                            </div>
                            <div class="profile-row-content">
                                <small class="profile-row-label">Mulai Bekerja</small>
                                <span class="profile-row-value">{{ $profil['mulai_kerja'] }}</span>
                            </div>
                        </div>

                    </div>

                    {{-- Tombol Keluar --}}
                    <div class="text-center mt-4 pb-2">
                        <a href="{{ route('logout') }}" class="btn btn-logout-full">
                            <i class="bi bi-box-arrow-right me-2"></i> Keluar dari Sistem
                        </a>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
@endsection
