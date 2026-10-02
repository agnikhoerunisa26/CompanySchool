@extends('layouts.admin')

@section('title', 'Manajemen Artikel - Admin Panel')
@section('page-title', 'Daftar Artikel')

@section('content')

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Manajemen Artikel</h1>
            <div class="admin-breadcrumb-inline">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>&rsaquo;</span>
                <strong>Daftar Artikel</strong>
            </div>
        </div>
        <a href="{{ route('admin.artikel.create') }}" class="btn btn-navy admin-add-btn">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Artikel Baru
        </a>
    </div>

    @if (session('success'))
        <div class="admin-toast" id="adminToast">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="16 9 10.5 15 8 12.5"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-stats-grid admin-stats-grid-2">
        <div class="admin-stat-card">
            <div class="admin-stat-icon admin-stat-icon-artikel">
                @include('admin.partials.icon-artikel')
            </div>
            <div class="admin-stat-body">
                <span class="admin-stat-label">TOTAL ARTIKEL</span>
                <strong class="admin-stat-value">{{ $totalArtikel }}</strong>
            </div>
        </div>
        <div class="admin-stat-card">
            <div class="admin-stat-icon admin-stat-icon-published">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            </div>
            <div class="admin-stat-body">
                <span class="admin-stat-label">PUBLISHED</span>
                <strong class="admin-stat-value">{{ $totalPublish }}</strong>
            </div>
        </div>
    </div>

    <div class="admin-table-box">
        <div class="admin-table-toolbar">
            <form action="{{ route('admin.artikel.index') }}" method="GET" class="admin-search-form">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari artikel...">
            </form>
            <div class="admin-table-actions">
                <button type="button" class="admin-filter-btn">Semua Status</button>
                <button type="button" class="admin-filter-btn">
                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                    Filter
                </button>
            </div>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>JUDUL ARTIKEL</th>
                    <th>TANGGAL</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($articles as $index => $article)
                    <tr>
                        <td>{{ $startNumber + $index + 1 }}</td>
                        <td>
                            <div class="admin-table-title">
                                <img src="{{ asset('images/' . $article['image']) }}" alt="{{ $article['title'] }}">
                                <span>{{ $article['title'] }}</span>
                            </div>
                        </td>
                        <td>{{ $article['date'] }}</td>
                        <td><span class="admin-badge-publish">Publish</span></td>
                        <td>
                            <div class="admin-table-aksi">
                                <a href="{{ route('admin.artikel.edit', $article['id']) }}" class="admin-icon-btn admin-icon-edit" title="Edit">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <form action="{{ route('admin.artikel.destroy', $article['id']) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
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
                        <td colspan="5" class="admin-table-empty">Tidak ada artikel ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="admin-table-footer">
            <span>Menampilkan {{ $startNumber + 1 }} - {{ $startNumber + $articles->count() }} dari {{ $totalData }} data</span>

            @if ($totalPages > 1)
                <div class="admin-pagination">
                    <a href="{{ route('admin.artikel.index') }}?page={{ max(1, $currentPage - 1) }}&search={{ $search }}" class="admin-page-btn {{ $currentPage <= 1 ? 'disabled' : '' }}">&lsaquo;</a>
                    @for ($i = 1; $i <= $totalPages; $i++)
                        <a href="{{ route('admin.artikel.index') }}?page={{ $i }}&search={{ $search }}" class="admin-page-btn {{ $i == $currentPage ? 'active' : '' }}">{{ $i }}</a>
                    @endfor
                    <a href="{{ route('admin.artikel.index') }}?page={{ min($totalPages, $currentPage + 1) }}&search={{ $search }}" class="admin-page-btn {{ $currentPage >= $totalPages ? 'disabled' : '' }}">&rsaquo;</a>
                </div>
            @endif
        </div>
    </div>

@endsection

@section('scripts')
<script>
    // Toast otomatis hilang setelah 3 detik
    const toast = document.getElementById('adminToast');
    if (toast) {
        setTimeout(() => { toast.style.display = 'none'; }, 3000);
    }
</script>
@endsection