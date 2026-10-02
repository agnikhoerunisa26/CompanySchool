<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SMK Negeri 4 Kota Bogor')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- CSS & JS global di-compile Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <header class="navbar">
    <div class="navbar-container">
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="{{ asset('images/logosekolah.png') }}" alt="Logo SMK Negeri 4 Kota Bogor" class="navbar-logo">
            <span>SMK NEGERI 4 KOTA BOGOR</span>
        </a>

        <nav class="navbar-menu" id="navbarMenu">
            <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="{{ url('/profil') }}" class="nav-link {{ request()->is('profil') ? 'active' : '' }}">Profil</a>
            <a href="{{ url('/artikel') }}" class="nav-link {{ request()->is('artikel*') ? 'active' : '' }}">Artikel</a>
            <a href="{{ url('/galeri') }}" class="nav-link {{ request()->is('galeri') ? 'active' : '' }}">Galeri</a>
            <a href="{{ url('/ekstrakurikuler') }}" class="nav-link {{ request()->is('ekstrakurikuler*') ? 'active' : '' }}">Ekstrakurikuler</a>
            <a href="{{ url('/produk') }}" class="nav-link {{ request()->is('produk*') ? 'active' : '' }}">Produk</a>
            <a href="{{ url('/kontak') }}" class="nav-link {{ request()->is('kontak') ? 'active' : '' }}">Kontak</a>

            {{-- Hanya tampil di HP (di dalam menu hamburger) --}}
            <a href="{{ url('/login') }}" class="nav-link nav-login-mobile">Login Admin</a>
        </nav>

        {{-- Hanya tampil di desktop --}}
        <a href="{{ url('/login') }}" class="navbar-login">Login Admin</a>

        <button class="navbar-toggle" id="navbarToggle" aria-label="Buka menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>
    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-col">
                <h3>SMK NEGERI 4 KOTA BOGOR</h3>
                <p>Mewujudkan generasi unggul, berkarakter, dan kompeten di bidang teknologi dan kejuruan.</p>
            </div>

            <div class="footer-col">
                <h4>Tautan Cepat</h4>
                <ul>
                    <li><a href="{{ url('/profil#sejarah') }}">Sejarah</a></li>
                    <li><a href="{{ url('/profil#visi-misi') }}">Visi Misi</a></li>
                    <li><a href="{{ url('/artikel') }}">Berita Terbaru</a></li>
                    <li><a href="{{ url('/kontak') }}">Hubungi Kami</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Kontak Kami</h4>
                <ul class="footer-contact">
                    <li>Jl. Raya Tajur, Kp. Buntar, RT.02/RW.08, Kel. Muarasari, Kec. Bogor Selatan, Kota Bogor, Jawa Barat 16137.</li>
                    <li>(0251) 8335764</li>
                    <li>info@smkn4bogor.sch.id</li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Lokasi</h4>
                <div class="footer-map">
                    <iframe
                        src="https://www.google.com/maps?q=SMK+Negeri+4+Kota+Bogor&output=embed"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} SMK Negeri 4 Bogor. All rights reserved.</p>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>