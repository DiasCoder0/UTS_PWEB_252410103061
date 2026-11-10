<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FLOSSLOOP - @yield('title', 'Sistem Pencatatan Hasil Panen')</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Slot untuk CSS tambahan per halaman --}}
    @yield('styles')
</head>
<body>

    {{-- Navbar Component --}}
    <x-navbar />

    {{-- Konten utama tiap halaman --}}
    <main class="main-content">
        <div id="pageContent">
            @yield('content')
        </div>
    </main>

    {{-- Footer Component --}}
    <x-footer />

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Animasi page transition --}}
    <script>
        // Fade-in saat halaman pertama kali dimuat
        document.addEventListener('DOMContentLoaded', () => {
            const content = document.getElementById('pageContent');
            if (content) {
                content.style.opacity = '0';
                content.style.transform = 'translateY(16px)';
                content.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                // Trigger animasi setelah render
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => {
                        content.style.opacity = '1';
                        content.style.transform = 'translateY(0)';
                    });
                });
            }
        });

        // Fade-out saat klik link navigasi
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (
                link &&
                link.href &&
                !link.href.startsWith('#') &&
                link.target !== '_blank' &&
                link.origin === window.location.origin
            ) {
                e.preventDefault();
                const content = document.getElementById('pageContent');
                if (content) {
                    content.style.transition = 'opacity 0.25s ease, transform 0.25s ease';
                    content.style.opacity = '0';
                    content.style.transform = 'translateY(-10px)';
                    setTimeout(() => { window.location.href = link.href; }, 250);
                } else {
                    window.location.href = link.href;
                }
            }
        });
    </script>

    {{-- Slot untuk JS tambahan per halaman --}}
    @yield('scripts')

</body>
</html>
