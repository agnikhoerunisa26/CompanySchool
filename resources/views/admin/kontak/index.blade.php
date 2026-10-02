@extends('layouts.admin')

@section('title', 'Manajemen Kontak - Admin Panel')
@section('page-title', 'Pesan Masuk')

@section('content')

    @if (session('success'))
        <div class="admin-toast" id="adminToast">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="16 9 10.5 15 8 12.5"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Manajemen Kontak</h1>
            <div class="admin-breadcrumb-inline">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>&rsaquo;</span>
                <strong>Pesan Masuk</strong>
            </div>
        </div>
    </div>

    <div class="admin-stats-grid admin-stats-grid-2">
        <div class="admin-stat-card">
            <div class="admin-stat-icon admin-stat-icon-artikel">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16v16H4z" opacity="0"/><path d="M22 6l-10 7L2 6"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>
            </div>
            <div class="admin-stat-body">
                <span class="admin-stat-label">TOTAL PESAN</span>
                <strong class="admin-stat-value">{{ $totalPesan }}</strong>
            </div>
        </div>
        <div class="admin-stat-card">
            <div class="admin-stat-icon" style="background:#fee2e2; color:#dc2626;">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
            </div>
            <div class="admin-stat-body">
                <span class="admin-stat-label">BELUM DIBACA</span>
                <strong class="admin-stat-value">{{ $belumDibaca }}</strong>
            </div>
        </div>
    </div>

    <div class="admin-table-box">
        <div class="admin-table-toolbar">
            <form action="{{ route('admin.kontak.index') }}" method="GET" class="admin-search-form">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama atau subjek...">
            </form>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>PENGIRIM</th>
                    <th>SUBJEK</th>
                    <th>TANGGAL</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pesanList as $index => $pesan)
                    <tr>
                        <td>{{ $startNumber + $index + 1 }}</td>
                        <td>
                            <strong style="display:block; color:var(--text-dark); font-size:0.9rem;">{{ $pesan->nama }}</strong>
                            <span style="font-size:0.8rem; color:var(--text-muted);">{{ $pesan->email }}</span>
                        </td>
                        <td>{{ $pesan->subjek }}</td>
                        <td>{{ $pesan->tanggal }}</td>
                        <td>
                            @if ($pesan->sudah_dibaca)
                                <span class="admin-badge-publish">Dibaca</span>
                            @else
                                <span class="admin-badge-nonaktif">Baru</span>
                            @endif
                        </td>
                        <td>
                            <div class="admin-table-aksi">
                                <a href="{{ route('admin.kontak.show', $pesan->id) }}" class="admin-icon-btn admin-icon-edit" title="Lihat Pesan">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </a>
                                <form action="{{ route('admin.kontak.destroy', $pesan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesan ini?');">
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
                        <td colspan="6" class="admin-table-empty">Belum ada pesan masuk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="admin-table-footer">
            <span>Menampilkan {{ $startNumber + 1 }} - {{ $startNumber + $pesanList->count() }} dari {{ $totalData }} pesan</span>

            @if ($totalPages > 1)
                <div class="admin-pagination">
                    @for ($i = 1; $i <= $totalPages; $i++)
                        <a href="{{ route('admin.kontak.index') }}?page={{ $i }}&search={{ $search }}" class="admin-page-btn {{ $i == $currentPage ? 'active' : '' }}">{{ $i }}</a>
                    @endfor
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