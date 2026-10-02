@extends('layouts.app')

@section('title', 'Beranda - SMK Negeri 4 Kota Bogor')

@section('content')

    {{-- ===== HERO ===== --}}
    <section class="hero">
        <img src="{{ asset('images/lap1.JPG') }}" alt="Lingkungan SMK Negeri 4 Kota Bogor" class="hero-bg">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>SMK NEGERI 4 KOTA BOGOR</h1>
            <p>Mewujudkan generasi unggul, berkarakter, dan kompeten di bidang teknologi dan kejuruan.</p>
            <div class="hero-buttons">
                <a href="{{ url('/profil') }}" class="btn btn-gold">Profil Sekolah</a>
                <a href="{{ url('/kontak') }}" class="btn btn-outline-white">Hubungi Kami</a>
            </div>
        </div>
    </section>

    {{-- ===== 4 KARTU FITUR ===== --}}
    <section class="features">
        <div class="features-container">
            @foreach ($features as $feature)
                <div class="feature-card">
                    <div class="feature-icon feature-icon-{{ $feature['icon'] }}">
                        @include('partials.icons.' . $feature['icon'])
                    </div>
                    <h3>{{ $feature['title'] }}</h3>
                    <p>{{ $feature['description'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ===== SAMBUTAN KEPALA SEKOLAH ===== --}}
    <section class="sambutan">
        <div class="sambutan-container">
            <div class="sambutan-photo">
                <img src="{{ asset('images/pamul1.jpeg') }}" alt="Kepala Sekolah SMK Negeri 4 Kota Bogor">
            </div>
            <div class="sambutan-text">
                <span class="section-label">Sambutan Kepala Sekolah</span>
                <p class="sambutan-quote">
                    "Selamat datang di website resmi SMK Negeri 4. Semoga website ini menjadi sumber informasi
                    yang bermanfaat serta sarana komunikasi yang efektif bagi seluruh warga sekolah dan
                    masyarakat dalam mendukung pendidikan yang berkualitas."
                </p>
                <p class="sambutan-name">Drs. Mulya Murprihartono, M.Si.</p>
                <p class="sambutan-role">Kepala Sekolah</p>
            </div>
        </div>
    </section>

    {{-- ===== ARTIKEL TERBARU ===== --}}
    <section class="artikel">
        <div class="artikel-header">
            <h2>Artikel Terbaru</h2>
            <a href="{{ url('/artikel') }}" class="link-arrow">Lihat Semua &rarr;</a>
        </div>
        <div class="artikel-grid">
            @foreach ($articles as $article)
                <article class="artikel-card">
                    <div class="artikel-thumb">
                        <img src="{{ asset('images/' . $article['image']) }}" alt="{{ $article['title'] }}">
                        @if ($article['badge'])
                            <span class="artikel-badge">{{ $article['badge'] }}</span>
                        @endif
                    </div>
                    <div class="artikel-body">
                        <span class="artikel-date">{{ $article['date'] }}</span>
                        <h3>{{ $article['title'] }}</h3>
                        <p>{{ $article['excerpt'] }}</p>
                        <a href="{{ route('artikel.show', $article['id']) }}" class="link-arrow">Baca Selengkapnya &rsaquo;</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{-- ===== PROGRAM KEAHLIAN ===== --}}
    <section class="program-keahlian">
        <h2>Program Keahlian</h2>
        <div class="program-grid">
            @foreach ($programs as $program)
                <div class="program-card">
                    <div class="program-thumb">
                        <img src="{{ asset('images/' . $program['image']) }}" alt="{{ $program['full'] }}">
                        <div class="program-logo">
                            <img src="{{ asset('images/' . $program['logo']) }}" alt="Logo {{ $program['name'] }}">
                        </div>
                    </div>
                    <h3>{{ $program['name'] }}</h3>
                    <p class="program-full">{{ $program['full'] }}</p>
                    <p class="program-desc">{{ $program['description'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ===== EKSTRAKURIKULER UNGGULAN ===== --}}
    <section class="ekskul">
        <h2>Ekstrakurikuler Unggulan</h2>
        <p class="ekskul-desc">
            Temukan berbagai kegiatan ekstrakurikuler yang dirancang untuk mengembangkan potensi diri,
            memperluas pengalaman, serta membangun jiwa kepemimpinan, sportivitas, dan kerja sama.
        </p>
        <div class="ekskul-grid">
            @foreach ($ekskuls as $ekskul)
                <div class="ekskul-item">
                    <div class="ekskul-logo">
                        <img src="{{ asset('images/' . $ekskul['logo']) }}" alt="{{ $ekskul['name'] }}">
                    </div>
                    <span>{{ $ekskul['name'] }}</span>
                </div>
            @endforeach
        </div>
        <a href="{{ url('/ekstrakurikuler') }}" class="btn btn-navy">Pelajari Lebih Lanjut</a>
    </section>

@endsection