@extends('layouts.app')

@section('title', 'Produk Sekolah - SMK Negeri 4 Kota Bogor')

@section('content')

    {{-- ===== HERO ===== --}}
    <section class="produk-hero">
        <div class="produk-hero-content">
            <h1>Produk Sekolah</h1>
            <p>Menyediakan seragam dan atribut resmi SMKN 4 Bogor sebagai pelengkap kebutuhan peserta didik dalam mendukung kegiatan belajar di sekolah.</p>
        </div>
    </section>

    {{-- ===== DAFTAR PRODUK ===== --}}
    <section class="produk-list">
        <h2 class="produk-title">Menampilkan Beberapa <strong>Produk</strong> Sekolah :</h2>

        <div class="produk-grid">
            @foreach ($products as $product)
                <div class="produk-card">
                    <div class="produk-thumb">
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                    </div>
                    <div class="produk-body">
                        <h3>{{ $product->name }}</h3>
                        <span class="produk-kategori">{{ $product->kategori }}</span>
                        <div class="produk-footer">
                            <span class="produk-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

@endsection