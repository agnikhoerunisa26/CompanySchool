@extends('layouts.app')

@section('title', 'Kontak Kami - SMK Negeri 4 Kota Bogor')

@section('content')

    {{-- ===== HERO ===== --}}
    <section class="kontak-hero">
        <img src="{{ asset('images/lap3.JPG') }}" alt="Kontak SMK Negeri 4 Kota Bogor" class="hero-bg">
        <div class="hero-overlay"></div>
        <div class="kontak-hero-content">
            <h1>Kontak Kami</h1>
        </div>
    </section>

    {{-- ===== NOTIFIKASI ===== --}}
    @if (session('success'))
        <div class="kontak-alert-wrap">
            <div class="kontak-alert">{{ session('success') }}</div>
        </div>
    @endif

    {{-- ===== FORM & INFO ===== --}}
    <section class="kontak-section">
        <div class="kontak-grid">

            {{-- Form Kirim Pesan --}}
            <div class="kontak-form-box">
                <h2>Kirim Pesan</h2>
                <p>Silakan isi formulir di bawah ini untuk pertanyaan, saran, atau informasi lebih lanjut mengenai SMK Negeri 4 Kota Bogor.</p>

                <form action="{{ route('kontak.send') }}" method="POST">
                    @csrf

                    <div class="kontak-form-row">
                        <div>
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama">
                            @error('nama') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh@email.com">
                            @error('email') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <label>Subjek</label>
                    <input type="text" name="subjek" value="{{ old('subjek') }}" placeholder="Tuliskan subjek pesan">
                    @error('subjek') <span class="form-error">{{ $message }}</span> @enderror

                    <label>Pesan</label>
                    <textarea name="pesan" rows="5" placeholder="Tuliskan pesan Anda...">{{ old('pesan') }}</textarea>
                    @error('pesan') <span class="form-error">{{ $message }}</span> @enderror

                    <button type="submit" class="btn btn-navy kontak-submit">
                        Kirim Pesan
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    </button>
                </form>
            </div>

            {{-- Info Kontak & Maps --}}
            <div class="kontak-side">
                <div class="kontak-info-box">
                    <h2>Informasi Kontak</h2>

                    <div class="kontak-info-item">
                        <span class="kontak-info-icon">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </span>
                        <div>
                            <strong>Alamat</strong>
                            <p>Jl. Raya Tajur, Kp. Buntar, RT.02/RW.08, Kel. Muarasari, Kec. Bogor Selatan, Kota Bogor, Jawa Barat 16137.</p>
                        </div>
                    </div>

                    <div class="kontak-info-item">
                        <span class="kontak-info-icon">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.362 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.338 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </span>
                        <div>
                            <strong>Telepon</strong>
                            <p>(0251) 8335754</p>
                        </div>
                    </div>

                    <div class="kontak-info-item">
                        <span class="kontak-info-icon">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16v16H4z" opacity="0"/><path d="M22 6l-10 7L2 6"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>
                        </span>
                        <div>
                            <strong>Email</strong>
                            <p>info@smkn4bogor.sch.id</p>
                        </div>
                    </div>

                    <div class="kontak-info-item">
                        <span class="kontak-info-icon">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </span>
                        <div>
                            <strong>Jam Operasional</strong>
                            <p>Senin - Jumat, 07:00 - 16:00 WIB</p>
                        </div>
                    </div>
                </div>

                <div class="kontak-map-box">
                    <iframe
                        src="https://www.google.com/maps?q=SMK+Negeri+4+Kota+Bogor&output=embed"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>

        {{-- Sosial Media --}}
        <div class="kontak-social-grid">
            <a href="https://www.instagram.com/smkn4bogor" target="_blank" rel="noopener" class="kontak-social-card">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/></svg>
                <span>Instagram</span>
            </a>
            <a href="http://www.youtube.com/@smknegeri4bogor905" target="_blank" rel="noopener" class="kontak-social-card">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.6A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.6 9.4.6 9.4.6s7.5 0 9.4-.6a3 3 0 0 0 2.1-2.1A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8ZM9.6 15.5V8.5L15.8 12Z"/></svg>
                <span>YouTube</span>
            </a>
            <a href="https://www.facebook.com/smkn4bogor" target="_blank" rel="noopener" class="kontak-social-card">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                <span>Facebook</span>
            </a>
        </div>
    </section>

@endsection