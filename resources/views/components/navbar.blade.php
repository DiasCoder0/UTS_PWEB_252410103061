<nav class="navbar navbar-expand-lg floss-navbar sticky-top">
    <div class="container">

        {{-- Logo --}}
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('images/logo.png') }}" alt="FLOSSLOOP Logo" class="navbar-logo">
        </a>

        {{-- Tombol toggle mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Menu navigasi --}}
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                       href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('stok-panen') ? 'active' : '' }}"
                       href="{{ route('stok-panen') }}">
                        <i class="bi bi-box-seam me-1"></i> Stok Panen
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tambah-barang') ? 'active' : '' }}"
                       href="{{ route('tambah-barang') }}">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Barang
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('distribusi') ? 'active' : '' }}"
                       href="{{ route('distribusi') }}">
                        <i class="bi bi-send me-1"></i> Distribusi
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('konversi-limbah') ? 'active' : '' }}"
                       href="{{ route('konversi-limbah') }}">
                        <i class="bi bi-arrow-repeat me-1"></i> Konversi
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}"
                       href="{{ route('profile') }}">
                        <i class="bi bi-person-circle me-1"></i> Profil
                    </a>
                </li>

                <li class="nav-item ms-lg-2">
                    <a class="btn btn-logout" href="{{ route('logout') }}">
                        <i class="bi bi-box-arrow-right me-1"></i> Keluar
                    </a>
                </li>

            </ul>
        </div>

    </div>
</nav>
