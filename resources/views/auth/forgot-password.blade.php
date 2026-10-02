<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - SMK Negeri 4 Kota Bogor</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="login-body">

    <div class="login-page">
        <img src="{{ asset('images/bgadmin.JPG') }}" alt="Background SMK Negeri 4 Kota Bogor" class="login-bg">
        <div class="login-overlay"></div>

        <div class="login-container">
            <div class="login-brand">
                <img src="{{ asset('images/logosekolah.png') }}" alt="Logo SMK Negeri 4 Kota Bogor" class="login-logo">
                <h1>SMK NEGERI 4 KOTA BOGOR</h1>
                <span>Portal Administrasi</span>
            </div>

            <div class="login-card">
                <div class="forgot-icon">
                    <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>

                <h2>Lupa Kata Sandi?</h2>
                <p>Untuk alasan keamanan, reset kata sandi akun admin tidak bisa dilakukan secara otomatis. Silakan hubungi Tim IT Sekolah untuk bantuan lebih lanjut.</p>

                <div class="forgot-contact-box">
                    <div class="forgot-contact-item">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.362 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.338 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <div>
                            <strong>Telepon</strong>
                            <span>(0251) 8335754</span>
                        </div>
                    </div>
                    <div class="forgot-contact-item">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16v16H4z" opacity="0"/><path d="M22 6l-10 7L2 6"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>
                        <div>
                            <strong>Email</strong>
                            <span>info@smkn4bogor.sch.id</span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('login') }}" class="btn btn-navy forgot-back-btn">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    Kembali ke Halaman Login
                </a>
            </div>

            <a href="{{ url('/') }}" class="login-back">&larr; Kembali ke Beranda Sekolah</a>
            <p class="login-copyright">&copy; {{ date('Y') }} SMK Negeri 4 Kota Bogor. Versi 2.1.0</p>
        </div>
    </div>

</body>
</html>