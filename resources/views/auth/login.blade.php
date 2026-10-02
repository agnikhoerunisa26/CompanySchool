<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SMK Negeri 4 Kota Bogor</title>

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
                <h2>Masuk Panel Kontrol</h2>
                <p>Gunakan akun resmi sekolah untuk mengelola konten dan data.</p>

                @if ($errors->any())
                    <div class="login-error">{{ $errors->first() }}</div>
                @endif

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf

                    <label>Email</label>
<input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email admin">

                    <label>Kata Sandi</label>
                    <div class="login-password-wrap">
                        <input type="password" name="password" id="passwordInput" placeholder="••••••••">
                        <button type="button" class="login-toggle-eye" onclick="togglePassword()">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>

                    <div class="login-options">
                        <label class="login-remember">
                            <input type="checkbox" name="remember">
                            Ingat saya
                        </label>
                        <a href="{{ route('forgot-password') }}">Lupa kata sandi?</a>
                    </div>

                    <button type="submit" class="btn btn-navy login-submit">
                        Masuk Admin
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                    </button>
                </form>

                <div class="login-footer-help">
    Kesulitan masuk? <a href="https://wa.me/6281401641971?text=Halo%20Tim%20IT%2C%20saya%20butuh%20bantuan%20login%20ke%20Admin%20Panel" target="_blank">Hubungi Tim IT Sekolah</a>
</div>>
            </div>

            <a href="{{ url('/') }}" class="login-back">&larr; Kembali ke Beranda Sekolah</a>
            <p class="login-copyright">&copy; {{ date('Y') }} SMK Negeri 4 Kota Bogor. Versi 2.1.0</p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>

</body>
</html>