@extends('layouts.app')

@section('title', 'Ekstrakurikuler - SMK Negeri 4 Kota Bogor')

@section('content')

    {{-- ===== HERO ===== --}}
    <section class="eskul-hero">
        <img src="{{ asset('images/eskul1bg.JPG') }}" alt="Ekstrakurikuler SMK Negeri 4 Kota Bogor" class="hero-bg">
        <div class="hero-overlay"></div>
        <div class="eskul-hero-content">
            <h1>Daftar Ekstrakurikuler</h1>
            <p>Temukan wadah kreativitas dan pengembangan diri terbaik di SMK Negeri 4 Kota Bogor melalui berbagai pilihan klub dan organisasi.</p>
        </div>
    </section>

    {{-- ===== GRID EKSTRAKURIKULER ===== --}}
    <section class="eskul-list">
        <div class="eskul-grid">
            @foreach ($ekskuls as $ekskul)
                <div class="eskul-card">
                    <div class="eskul-badge">{{ strtoupper($ekskul['name']) }}</div>
                    <div class="eskul-thumb">
                        <img src="{{ asset('images/' . $ekskul['image']) }}" alt="{{ $ekskul['name'] }}">
                    </div>
                    <div class="eskul-body">
                        <h3>Apa Itu {{ $ekskul['name'] }} ?</h3>
                        <p>{{ $ekskul['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ===== CTA BERGABUNG ===== --}}
    <section class="eskul-cta">
        <h2>Tertarik untuk Bergabung?</h2>
        <p>Pendaftaran ekstrakurikuler dibuka setiap awal semester. Silakan hubungi koordinator masing-masing klub atau kunjungi ruang kesiswaan.</p>
    </section>

@endsection