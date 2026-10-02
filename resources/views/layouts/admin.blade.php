<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - SMK Negeri 4 Kota Bogor')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-body">

    <div class="admin-layout">

        {{-- ===== SIDEBAR ===== --}}
        <aside class="admin-sidebar">
            <div class="admin-sidebar-top">
                <h1>Admin Panel</h1>
                <span>SMKN 4 KOTA BOGOR</span>
            </div>

            <nav class="admin-nav">
                <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.artikel.index') }}" class="admin-nav-link {{ request()->routeIs('admin.artikel.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                    Artikel
                </a>
                <a href="{{ route('admin.produk.index') }}" class="admin-nav-link {{ request()->routeIs('admin.produk.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                    Produk
                </a>
                <a href="{{ route('admin.ekstrakurikuler.index') }}" class="admin-nav-link {{ request()->routeIs('admin.ekstrakurikuler.*') ? 'active' : '' }}">
    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    Ekstrakurikuler
</a>
   <a href="{{ route('admin.galeri.index') }}" class="admin-nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
    Galeri
</a>
<a href="{{ route('admin.kontak.index') }}" class="admin-nav-link {{ request()->routeIs('admin.kontak.*') ? 'active' : '' }}">
    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16v16H4z" opacity="0"/><path d="M22 6l-10 7L2 6"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>
    Kontak
</a>
            </nav>

            <div class="admin-sidebar-bottom">
                <div class="admin-user-mini">
                    <strong>Admin Galeri</strong>
                    <span>SUPER ADMIN</span>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="admin-logout-btn">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- ===== MAIN CONTENT ===== --}}
        <div class="admin-main">
            <header class="admin-topbar">
                <div class="admin-breadcrumb">
                    Admin &rsaquo; <strong>@yield('page-title', 'Dashboard')</strong>
                </div>
                <div class="admin-topbar-right">
                    <div class="admin-notif-wrap">
    <button class="admin-notif-btn" id="notifBtn" type="button">
        <svg viewBox="0 0 24 24" width="19" height="19" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
        @if ($unreadCount > 0)
            <span class="admin-notif-dot"></span>
        @endif
    </button>

    <div class="admin-notif-dropdown" id="notifDropdown">
        <div class="admin-notif-dropdown-header">
            <strong>Notifikasi</strong>
            @if ($unreadCount > 0)
                <form action="{{ route('admin.notifikasi.baca') }}" method="POST">
                    @csrf
                    <button type="submit" class="admin-notif-markread">Tandai semua dibaca</button>
                </form>
            @endif
        </div>

        <div class="admin-notif-list">
            @forelse ($notifications as $notif)
                <div class="admin-notif-item {{ $notif['read'] ? '' : 'unread' }}">
                    <strong>{{ $notif['title'] }}</strong>
                    <p>{{ $notif['message'] }}</p>
                    <span>{{ $notif['time'] }}</span>
                </div>
            @empty
                <div class="admin-notif-empty">Belum ada notifikasi.</div>
            @endforelse
        </div>
    </div>
</div>
                    <div class="admin-user-info">
                        <div class="admin-user-text">
                            <strong>Administrator</strong>
                            <span>Admin SMKN 4</span>
                        </div>
                        <div class="admin-user-avatar">A</div>
                    </div>
                </div>
            </header>

            <main class="admin-content">
                @yield('content')
            </main>
        </div>

    </div>
    <script>
        const notifBtn = document.getElementById('notifBtn');
        const notifDropdown = document.getElementById('notifDropdown');

        notifBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            notifDropdown.classList.toggle('show');
        });

        document.addEventListener('click', function (e) {
            if (!notifDropdown.contains(e.target) && !notifBtn.contains(e.target)) {
                notifDropdown.classList.remove('show');
            }
        });
    </script>

    @yield('scripts')
</body>
</html>