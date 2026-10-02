@extends('layouts.app')

@section('title', 'Artikel & Berita - SMK Negeri 4 Kota Bogor')

@section('content')

    {{-- ===== HERO ===== --}}
    <section class="artikel-hero">
        <img src="{{ asset('images/lap2.JPG') }}" alt="Artikel & Berita SMK Negeri 4 Kota Bogor" class="hero-bg">
        <div class="hero-overlay"></div>
        <div class="artikel-hero-content">
            <h1>Artikel & Berita</h1>
            <p>Temukan informasi terbaru seputar kegiatan sekolah, prestasi siswa, dan pembaruan kurikulum di SMK Negeri 4 Kota Bogor.</p>
        </div>
    </section>

    {{-- ===== DAFTAR ARTIKEL ===== --}}
    <section class="artikel-list">

        {{-- Baris pertama: 1 artikel besar (featured) + 2 artikel kecil --}}
        <div class="artikel-top-grid">
            @if ($featured)
                <article class="artikel-card artikel-card-featured">
                    <div class="artikel-thumb">
                        <img src="{{ asset('images/' . $featured['image']) }}" alt="{{ $featured['title'] }}">
                        @if ($featured['badge'])
                            <span class="artikel-badge">{{ $featured['badge'] }}</span>
                        @endif
                    </div>
                    <div class="artikel-body">
                        <span class="artikel-date">
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            {{ $featured['date'] }}
                        </span>
                        <h2>{{ $featured['title'] }}</h2>
                        <p>{{ $featured['excerpt'] }}</p>
                        <a href="{{ route('artikel.show', $featured['id']) }}" class="link-arrow">Selengkapnya &rsaquo;</a>
                    </div>
                </article>
            @endif

            <div class="artikel-side-grid">
                @foreach ($others->take(2) as $article)
                    <a href="{{ route('artikel.show', $article['id']) }}" class="artikel-card">
                        <div class="artikel-thumb">
                            <img src="{{ asset('images/' . $article['image']) }}" alt="{{ $article['title'] }}">
                        </div>
                        <div class="artikel-body">
                            <span class="artikel-date">
                                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                {{ $article['date'] }}
                            </span>
                            <h3>{{ $article['title'] }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Baris kedua: 3 artikel biasa --}}
        <div class="artikel-bottom-grid">
            @foreach ($others->skip(2) as $article)
                <a href="{{ route('artikel.show', $article['id']) }}" class="artikel-card">
                    <div class="artikel-thumb">
                        <img src="{{ asset('images/' . $article['image']) }}" alt="{{ $article['title'] }}">
                    </div>
                    <div class="artikel-body">
                        <span class="artikel-date">
                            <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            {{ $article['date'] }}
                        </span>
                        <h3>{{ $article['title'] }}</h3>
                        <p>{{ $article['excerpt'] }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Pagination sungguhan --}}
        <div class="artikel-pagination">
            <a href="{{ url('/artikel') }}?page={{ max(1, $currentPage - 1) }}"
               class="page-btn {{ $currentPage <= 1 ? 'disabled' : '' }}">&lsaquo;</a>

            @for ($i = 1; $i <= $totalPages; $i++)
                <a href="{{ url('/artikel') }}?page={{ $i }}"
                   class="page-btn {{ $i == $currentPage ? 'active' : '' }}">{{ $i }}</a>
            @endfor

            <a href="{{ url('/artikel') }}?page={{ min($totalPages, $currentPage + 1) }}"
               class="page-btn {{ $currentPage >= $totalPages ? 'disabled' : '' }}">&rsaquo;</a>
        </div>

    </section>

@endsection