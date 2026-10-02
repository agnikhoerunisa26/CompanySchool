@extends('layouts.app')

@section('title', 'Galeri Sekolah - SMK Negeri 4 Kota Bogor')

@section('content')

    {{-- ===== HERO ===== --}}
    <section class="galeri-hero">
        <img src="{{ asset('images/galeri1.JPG') }}" alt="Galeri SMK Negeri 4 Kota Bogor" class="hero-bg">
        <div class="hero-overlay"></div>
        <div class="galeri-hero-content">
            <h1>Galeri Sekolah</h1>
            <p>Jelajahi momen-momen berharga dan prestasi membanggakan melalui koleksi visual kegiatan kami.</p>
        </div>
    </section>

    {{-- ===== FILTER KATEGORI ===== --}}
    <div class="galeri-filter">
        <a href="{{ url('/galeri') }}?kategori=semua" class="filter-btn {{ $kategori == 'semua' ? 'active' : '' }}">Semua</a>
        <a href="{{ url('/galeri') }}?kategori=prestasi" class="filter-btn {{ $kategori == 'prestasi' ? 'active' : '' }}">Prestasi</a>
        <a href="{{ url('/galeri') }}?kategori=kegiatan" class="filter-btn {{ $kategori == 'kegiatan' ? 'active' : '' }}">Kegiatan</a>
        <a href="{{ url('/galeri') }}?kategori=fasilitas" class="filter-btn {{ $kategori == 'fasilitas' ? 'active' : '' }}">Fasilitas</a>
    </div>

    {{-- ===== GRID GALERI ===== --}}
    <section class="galeri-list">

        @if ($useGrid3)
            {{-- Grid 3 kolom rata untuk Prestasi & Kegiatan --}}
            <div class="galeri-grid-prestasi">
                @foreach ($photos as $photo)
                    <div class="galeri-item galeri-item-square">
                        <img src="{{ asset('images/' . $photo['image']) }}" alt="{{ $photo['caption'] }}">
                    </div>
                @endforeach
            </div>
        @else
            {{-- Bento layout untuk Semua/Fasilitas --}}
            <div class="galeri-columns">
                <div class="galeri-col">
                    @if (isset($photos[0]))
                        <div class="galeri-item galeri-item-lg">
                            <img src="{{ asset('images/' . $photos[0]['image']) }}" alt="{{ $photos[0]['caption'] }}">
                        </div>
                    @endif

                    <div class="galeri-row-2">
                        @if (isset($photos[2]))
                            <div class="galeri-item">
                                <img src="{{ asset('images/' . $photos[2]['image']) }}" alt="{{ $photos[2]['caption'] }}">
                            </div>
                        @endif
                        @if (isset($photos[3]))
                            <div class="galeri-item">
                                <img src="{{ asset('images/' . $photos[3]['image']) }}" alt="{{ $photos[3]['caption'] }}">
                            </div>
                        @endif
                    </div>

                    @if (isset($photos[5]))
                        <div class="galeri-item galeri-item-wide">
                            <img src="{{ asset('images/' . $photos[5]['image']) }}" alt="{{ $photos[5]['caption'] }}">
                        </div>
                    @endif
                </div>

                <div class="galeri-col">
                    @if (isset($photos[1]))
                        <div class="galeri-item galeri-item-tall">
                            <img src="{{ asset('images/' . $photos[1]['image']) }}" alt="{{ $photos[1]['caption'] }}">
                        </div>
                    @endif
                    @if (isset($photos[4]))
                        <div class="galeri-item galeri-item-tall">
                            <img src="{{ asset('images/' . $photos[4]['image']) }}" alt="{{ $photos[4]['caption'] }}">
                        </div>
                    @endif
                </div>
            </div>
        @endif

        {{-- Pagination (hanya tampil jika lebih dari 1 halaman) --}}
        @if ($totalPages > 1)
            <div class="galeri-pagination">
                <a href="{{ url('/galeri') }}?kategori={{ $kategori }}&page={{ max(1, $currentPage - 1) }}"
                   class="page-btn {{ $currentPage <= 1 ? 'disabled' : '' }}">&lsaquo;</a>

                @for ($i = 1; $i <= $totalPages; $i++)
                    <a href="{{ url('/galeri') }}?kategori={{ $kategori }}&page={{ $i }}"
                       class="page-btn {{ $i == $currentPage ? 'active' : '' }}">{{ $i }}</a>
                @endfor

                <a href="{{ url('/galeri') }}?kategori={{ $kategori }}&page={{ min($totalPages, $currentPage + 1) }}"
                   class="page-btn {{ $currentPage >= $totalPages ? 'disabled' : '' }}">&rsaquo;</a>
            </div>
        @endif
    </section>

    {{-- ===== CTA SOSIAL MEDIA ===== --}}
    <section class="galeri-cta">
        <h2>Ingin Melihat Lebih Banyak?</h2>
        <p>Ikuti perjalanan kami setiap hari melalui media sosial resmi SMK Negeri 4 Kota Bogor untuk update kegiatan terbaru.</p>
        <div class="galeri-cta-buttons">
            <a href="http://www.youtube.com/@smknegeri4bogor905" target="_blank" rel="noopener" class="btn-social">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.6A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.6 9.4.6 9.4.6s7.5 0 9.4-.6a3 3 0 0 0 2.1-2.1A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8ZM9.6 15.5V8.5L15.8 12Z"/></svg>
                YouTube
            </a>
            <a href="https://www.instagram.com/smkn4bogor" target="_blank" rel="noopener" class="btn-social">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/></svg>
                Instagram
            </a>
        </div>
    </section>

@endsection