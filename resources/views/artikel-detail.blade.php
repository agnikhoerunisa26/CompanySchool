@extends('layouts.app')

@section('title', $article['title'] . ' - SMK Negeri 4 Kota Bogor')

@section('content')

    <section class="detail-section">
        <div class="detail-breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            <span>&rsaquo;</span>
            <a href="{{ route('artikel') }}">Artikel</a>
            <span>&rsaquo;</span>
            <span>{{ $article['title'] }}</span>
        </div>

        <div class="detail-header">
            @if ($article['badge'])
                <span class="detail-badge">{{ $article['badge'] }}</span>
            @endif
            <h1>{{ $article['title'] }}</h1>
            <span class="detail-date">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                {{ $article['date'] }}
            </span>
        </div>

        <div class="detail-image">
            <img src="{{ asset('images/' . $article['image']) }}" alt="{{ $article['title'] }}">
        </div>

        <div class="detail-content">
            @foreach (explode("\n\n", $article['content']) as $paragraf)
                <p>{{ $paragraf }}</p>
            @endforeach
        </div>

        <a href="{{ route('artikel') }}" class="link-arrow detail-back">&lsaquo; Kembali ke Semua Artikel</a>

        @if ($related->count() > 0)
            <div class="detail-related">
                <h2>Artikel Lainnya</h2>
                <div class="detail-related-grid">
                    @foreach ($related as $item)
                        <a href="{{ route('artikel.show', $item['id']) }}" class="detail-related-card">
                            <div class="detail-related-thumb">
                                <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['title'] }}">
                            </div>
                            <div class="detail-related-body">
                                <span>{{ $item['date'] }}</span>
                                <h3>{{ $item['title'] }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </section>

@endsection