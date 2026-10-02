@extends('layouts.admin')

@section('title', $formTitle . ' - Admin Panel')
@section('page-title', 'Galeri')

@section('content')

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">{{ $formTitle }}</h1>
            <div class="admin-breadcrumb-inline">
                <a href="{{ route('admin.dashboard') }}">Admin</a> &rsaquo;
                <a href="{{ route('admin.galeri.index') }}">Daftar Galeri</a> &rsaquo;
                <strong>{{ $galeri ? 'Edit Media' : 'Tambah Media' }}</strong>
            </div>
        </div>
    </div>

    <div class="admin-table-box admin-form-box-wide">
        <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($galeri)
                @method('PUT')
            @endif

            <label class="admin-form-label">Foto Media</label>
            <label for="fotoInput" class="admin-upload-box admin-upload-box-wide">
                @if ($galeri)
                    <img src="{{ asset('images/' . $galeri->image) }}" alt="Foto media">
                @else
                    <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                    <span><strong>Upload a file</strong> or drag and drop</span>
                    <span class="admin-upload-note">PNG, JPG, GIF up to 10MB</span>
                @endif
            </label>
            <input type="file" id="fotoInput" name="foto" accept="image/*" class="admin-file-input">
            @error('foto') <span class="form-error">{{ $message }}</span> @enderror

            <div class="admin-form-row-2">
                <div class="admin-form-box">
                    <label class="admin-form-label">Kategori</label>
                    <select name="kategori">
                        <option value="" disabled {{ !$galeri ? 'selected' : '' }}>Pilih Kategori...</option>
                        <option value="Kegiatan" {{ $galeri && $galeri->kategori == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                        <option value="Prestasi" {{ $galeri && $galeri->kategori == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                        <option value="Fasilitas" {{ $galeri && $galeri->kategori == 'Fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                    </select>
                </div>
                <div class="admin-form-box">
                    <label class="admin-form-label">Tanggal Media</label>
                    <input type="date" name="tanggal_media" value="{{ $galeri->tanggal_media ?? '' }}">
                </div>
            </div>

            <hr class="admin-form-divider">

            <div class="admin-form-actions">
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-navy">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Simpan Media
                </button>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
<script>
    const fotoInput = document.getElementById('fotoInput');
    const uploadBox = fotoInput.previousElementSibling;

    fotoInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                uploadBox.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection