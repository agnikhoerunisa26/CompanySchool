@extends('layouts.admin')

@section('title', 'Manajemen Produk - Admin Panel')
@section('page-title', 'Manajemen Produk')

@section('content')

    @if (session('success'))
        <div class="admin-toast" id="adminToast">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="16 9 10.5 15 8 12.5"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-table-box">
        <div class="admin-produk-header">
            <div class="admin-produk-title-row">
                <h2>Daftar Produk Sekolah</h2>
                <span class="admin-badge-total">Total {{ $totalProduk }} Produk</span>
            </div>
           <a href="{{ route('admin.produk.create') }}" class="btn btn-navy admin-add-btn">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                Tambah Produk Baru
            </a>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>INFO PRODUK</th>
                    <th>HARGA</th>
                    <th>STOK</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $index => $product)
                    <tr>
                        <td>{{ $startNumber + $index + 1 }}</td>
                        <td>
                            <div class="admin-table-title">
                                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                                <div>
                                    <span class="admin-produk-name">{{ $product->name }}</span>
                                    <span class="admin-produk-kategori">{{ $product->kategori }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="admin-produk-price">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            <span class="admin-stok-dot"></span>
                            {{ $product->stok }} Unit
                        </td>
                        <td>
                            <div class="admin-table-aksi">
                                <a href="{{ route('admin.produk.edit', $product->id) }}" class="admin-icon-btn admin-icon-edit" title="Edit">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <form action="{{ route('admin.produk.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-icon-btn admin-icon-delete" title="Hapus">
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="admin-table-empty">Tidak ada produk ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="admin-table-footer">
            <span>Menampilkan {{ $startNumber + 1 }} - {{ $startNumber + $products->count() }} dari {{ $totalData }} data</span>

            @if ($totalPages > 1)
                <div class="admin-pagination">
                    <a href="{{ route('admin.produk.index') }}?page={{ max(1, $currentPage - 1) }}" class="admin-page-btn {{ $currentPage <= 1 ? 'disabled' : '' }}">&lsaquo;</a>
                    @for ($i = 1; $i <= $totalPages; $i++)
                        <a href="{{ route('admin.produk.index') }}?page={{ $i }}" class="admin-page-btn {{ $i == $currentPage ? 'active' : '' }}">{{ $i }}</a>
                    @endfor
                    <a href="{{ route('admin.produk.index') }}?page={{ min($totalPages, $currentPage + 1) }}" class="admin-page-btn {{ $currentPage >= $totalPages ? 'disabled' : '' }}">&rsaquo;</a>
                </div>
            @endif
        </div>
    </div>

    <div class="admin-stats-grid admin-stats-grid-2">
        <div class="admin-simple-stat">
            <span>Total Produk</span>
            <strong>{{ $totalProduk }}</strong>
        </div>
        <div class="admin-simple-stat">
            <span>Kategori</span>
            <strong>{{ $totalKategori }}</strong>
        </div>
    </div>

    <div class="admin-info-box">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
        <div>
            <strong>Informasi Sinkronisasi</strong>
            <p>Data stok produk disinkronkan secara otomatis dengan Koperasi Sekolah setiap 30 menit. Terakhir diperbarui: 10 menit yang lalu.</p>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    const toast = document.getElementById('adminToast');
    if (toast) {
        setTimeout(() => { toast.style.display = 'none'; }, 3000);
    }
</script>
@endsection