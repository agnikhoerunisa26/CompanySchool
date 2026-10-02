@extends('layouts.admin')

@section('title', 'Manajemen Galeri - Admin Panel')
@section('page-title', 'Galeri')

@section('content')

    @if (session('success'))
        <div class="admin-toast" id="adminToast">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="16 9 10.5 15 8 12.5"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-produk-header">
        <h2>Manajemen Galeri</h2>
        <a href="{{ route('admin.galeri.create') }}" class="btn btn-navy admin-add-btn">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Media Baru
        </a>
    </div>

    <div class="admin-stats-grid admin-stats-grid-3">
        <div class="admin-stat-card">
            <div class="admin-stat-icon admin-stat-icon-galeri-total">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
            </div>
            <div class="admin-stat-body">
                <span class="admin-stat-label">Total Media</span>
                <span class="admin-stat-value">{{ $totalMedia }}</span>
            </div>
        </div>

        <div class="admin-stat-card">
            <div class="admin-stat-icon admin-stat-icon-foto">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
            </div>
            <div class="admin-stat-body">
                <span class="admin-stat-label">Foto</span>
                <span class="admin-stat-value">{{ $totalFoto }}</span>
            </div>
        </div>

        <div class="admin-stat-card">
            <div class="admin-stat-icon admin-stat-icon-kategori">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l9 5-9 5-9-5 9-5z"/><path d="M3 12l9 5 9-5"/></svg>
            </div>
            <div class="admin-stat-body">
                <span class="admin-stat-label">Kategori</span>
                <span class="admin-stat-value">{{ $totalKategori }}</span>
            </div>
        </div>
    </div>

    <div class="admin-table-box">
        <div class="admin-table-toolbar">
            <form method="GET" action="{{ route('admin.galeri.index') }}" class="admin-filter-form">
                <select name="kategori" class="admin-filter-select" onchange="this.form.submit()">
                    <option value="semua" {{ $kategoriAktif == 'semua' ? 'selected' : '' }}>Semua Kategori</option>
                    <option value="Kegiatan" {{ $kategoriAktif == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                    <option value="Prestasi" {{ $kategoriAktif == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                    <option value="Fasilitas" {{ $kategoriAktif == 'Fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                </select>
            </form>
            <button type="button" class="admin-filter-btn">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                Filter
            </button>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>MEDIA</th>
                    <th>KATEGORI</th>
                    <th>TANGGAL</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($galeris as $index => $galeri)
                    <tr>
                        <td>{{ $startNumber + $index + 1 }}</td>
                        <td><img src="{{ asset('images/' . $galeri->image) }}" alt="Media galeri" class="admin-galeri-img"></td>
                        <td>
                            <span class="admin-badge-kategori admin-badge-{{ strtolower($galeri->kategori) }}">{{ $galeri->kategori }}</span>
                        </td>
                        <td>{{ $galeri->tanggal }}</td>
                        <td>
                            <div class="admin-table-aksi">
                                <a href="{{ route('admin.galeri.edit', $galeri->id) }}" class="admin-icon-btn admin-icon-edit" title="Edit">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <form action="{{ route('admin.galeri.destroy', $galeri->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus media ini?');">
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
                        <td colspan="5" class="admin-table-empty">Belum ada media galeri.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="admin-table-footer">
            <span>Menampilkan {{ $startNumber + 1 }} - {{ $startNumber + $galeris->count() }} dari {{ $totalData }} data</span>

            @if ($totalPages > 1)
                <div class="admin-pagination">
                    <a href="{{ route('admin.galeri.index') }}?page={{ max(1, $currentPage - 1) }}" class="admin-page-btn {{ $currentPage == 1 ? 'disabled' : '' }}">&lsaquo;</a>
                    @for ($i = 1; $i <= $totalPages; $i++)
                        <a href="{{ route('admin.galeri.index') }}?page={{ $i }}" class="admin-page-btn {{ $i == $currentPage ? 'active' : '' }}">{{ $i }}</a>
                    @endfor
                    <a href="{{ route('admin.galeri.index') }}?page={{ min($totalPages, $currentPage + 1) }}" class="admin-page-btn {{ $currentPage == $totalPages ? 'disabled' : '' }}">&rsaquo;</a>
                </div>
            @endif
        </div>
    </div>

@endsection

@section('scripts')
<script>
    const toast = document.getElementById('adminToast');
    if (toast) { setTimeout(() => { toast.style.display = 'none'; }, 3000); }
</script>
@endsection