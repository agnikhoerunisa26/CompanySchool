@extends('layouts.app')

@section('title', 'Profil Sekolah - SMK Negeri 4 Kota Bogor')

@section('content')

    {{-- ===== HERO ===== --}}
    <section class="profil-hero">
        <img src="{{ asset('images/profilsekolah.JPG') }}" alt="Lingkungan SMK Negeri 4 Kota Bogor" class="hero-bg">
        <div class="hero-overlay"></div>
        <div class="profil-hero-content">
            <h1>Profil Sekolah</h1>
            <p>Temukan informasi mengenai sejarah, visi misi, serta berbagai keunggulan yang dimiliki SMKN 4 Bogor.</p>
        </div>
    </section>

    {{-- ===== SEJARAH & KEPALA SEKOLAH ===== --}}
    <section class="sejarah">
        <div class="sejarah-container">
            <div class="sejarah-card">
                <h2>Sejarah Sekolah</h2>
                <div class="sejarah-photo">
                    <img src="{{ asset('images/' . $sejarah['image']) }}" alt="Sejarah SMK Negeri 4 Kota Bogor">
                </div>
                <p>{{ $sejarah['text'] }}</p>
            </div>

            <div class="kepsek-card">
                <h2>Kepala Sekolah</h2>
                <div class="kepsek-photo">
                    <img src="{{ asset('images/' . $kepalaSekolah['photo']) }}" alt="{{ $kepalaSekolah['name'] }}">
                </div>
                <h3>{{ $kepalaSekolah['name'] }}</h3>
                <p class="kepsek-label">Pesan Kepala Sekolah</p>
                @foreach ($kepalaSekolah['pesan'] as $paragraf)
                    <p class="kepsek-pesan">{{ $paragraf }}</p>
                @endforeach
                <p class="kepsek-jabatan">{{ $kepalaSekolah['jabatan'] }}</p>
            </div>
        </div>
    </section>

    {{-- ===== VISI & MISI ===== --}}
    <section class="visi-misi">
        <h2 class="section-title-center">Visi & Misi</h2>
        <div class="visimisi-container">
            <div class="visi-box">
                <span class="vm-icon">&#128065;</span>
                <h3>Visi Kami</h3>
                <p>"{{ $visi }}"</p>
            </div>

            <div class="misi-box">
                <span class="vm-icon">&#128640;</span>
                <h3>Misi Kami</h3>
                <ul class="misi-list">
                    @foreach ($misi as $item)
                        <li>
                            <span class="misi-check">&#10003;</span>
                            <span><strong>{{ $item['title'] }}:</strong> {{ $item['desc'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

     {{-- ===== TUJUAN KAMI ===== --}}
    <section class="tujuan">
        <h2 class="section-title-center">Tujuan Kami</h2>
        <p class="tujuan-subtitle">Langkah nyata SMK Negeri 4 Kota Bogor dalam mewujudkan visi dan misi sekolah.</p>

        <ol class="tujuan-list">
            @foreach ($tujuan as $item)
                <li>
                    <span class="tujuan-number">{{ $loop->iteration }}</span>
                    <div>
                        <strong>{{ $item['title'] }}</strong>
                        <p>{{ $item['desc'] }}</p>
                    </div>
                </li>
            @endforeach
        </ol>
    </section>

@endsection