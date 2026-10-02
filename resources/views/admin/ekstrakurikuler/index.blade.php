@extends('layouts.admin')

@section('title', 'Manajemen Program - Admin Panel')
@section('page-title', 'Ekstrakurikuler')

@section('content')

    @if (session('success'))
        <div class="admin-toast" id="adminToast">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="16 9 10.5 15 8 12.5"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-tabs">
    <a href="{{ route('admin.ekstrakurikuler.index') }}" class="admin-tab active">Daftar Ekstrakurikuler</a>
</div>
    <div class="admin-table-box">
        <div class="admin-produk-header">
            <h2>List Ekstrakurikuler</h2>
            <a href="{{ route('admin.ekstrakurikuler.create') }}" class="btn btn-navy admin-add-btn">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah Ekskul
            </a>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>GAMBAR</th>
                    <th>NAMA EKSTRAKURIKULER</th>
                    <th>DESKRIPSI</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ekskuls as $index => $ekskul)
                    <tr>
                        <td>{{ $startNumber + $index + 1 }}</td>
                        <td><img src="{{ asset('images/' . $ekskul->image) }}" alt="{{ $ekskul->name }}" class="admin-ekskul-img"></td>
                        <td><strong class="admin-ekskul-name">{{ $ekskul->name }}</strong></td>
                        <td class="admin-ekskul-desc">{{ $ekskul->description }}</td>
                        <td>
                            @if ($ekskul->status === 'aktif')
                                <span class="admin-badge-publish">Aktif</span>
                            @else
                                <span class="admin-badge-nonaktif">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="admin-table-aksi">
                                <a href="{{ route('admin.ekstrakurikuler.edit', $ekskul->id) }}" class="admin-icon-btn admin-icon-edit" title="Edit">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <form action="{{ route('admin.ekstrakurikuler.destroy', $ekskul->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ekstrakurikuler ini?');">
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
                        <td colspan="6" class="admin-table-empty">Belum ada data ekstrakurikuler.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="admin-table-footer">
            <span>Menampilkan {{ $startNumber + 1 }} - {{ $startNumber + $ekskuls->count() }} dari {{ $totalData }} ekskul</span>

            @if ($totalPages > 1)
                <div class="admin-pagination">
                    @for ($i = 1; $i <= $totalPages; $i++)
                        <a href="{{ route('admin.ekstrakurikuler.index') }}?page={{ $i }}" class="admin-page-btn {{ $i == $currentPage ? 'active' : '' }}">{{ $i }}</a>
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