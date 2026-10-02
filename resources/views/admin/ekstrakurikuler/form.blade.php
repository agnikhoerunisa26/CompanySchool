@extends('layouts.admin')

@section('title', $formTitle . ' - Admin Panel')
@section('page-title', 'Tambah Program')

@section('content')

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">{{ $formTitle }}</h1>
            <p class="admin-form-subtitle">Lengkapi formulir di bawah ini untuk menambahkan program ekstrakurikuler baru.</p>
        </div>
    </div>

    <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($ekskul)
            @method('PUT')
        @endif

        <div class="produk-form-layout">

            {{-- ===== KIRI: FOTO PROGRAM ===== --}}
            <div class="produk-form-col">
                <div class="reply-card">
                    <div class="produk-form-card-head">
                        <div>
                            <h3>Foto Program</h3>
                            <p>Unggah foto kegiatan ekstrakurikuler</p>
                        </div>
                    </div>

                    <label for="fotoEkskul" class="produk-upload-box" id="uploadBox">
                        <img id="previewImg"
                             src="{{ $ekskul ? asset('images/' . $ekskul->image) : '' }}"
                             style="{{ $ekskul ? '' : 'display:none;' }}"
                             alt="Preview">
                        <div id="uploadPlaceholder" style="{{ $ekskul ? 'display:none;' : '' }}">
                            <span class="produk-upload-icon">
                                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                            </span>
                            <strong>Tarik &amp; lepas gambar ke sini, atau Pilih File</strong>
                            <span>Format JPG, PNG, GIF</span>
                            <span class="produk-upload-max">Maksimal ukuran 5MB</span>
                        </div>
                    </label>
                    <input type="file" name="foto" id="fotoEkskul" accept="image/png, image/jpeg, image/gif" style="display:none;">
                </div>
            </div>

            {{-- ===== KANAN: INFORMASI PROGRAM ===== --}}
            <div class="reply-card produk-form-col-main">
                <h3>Informasi Program</h3>
                <p class="produk-form-desc">Lengkapi nama, deskripsi, dan status program ekstrakurikuler.</p>

                <label class="admin-form-label">Nama Ekstrakurikuler <span class="required">*</span></label>
                <input type="text" name="name" value="{{ old('name', $ekskul->name ?? '') }}" placeholder="Masukkan nama ekstrakurikuler (contoh: Pramuka)">
                @error('name') <span class="form-error">{{ $message }}</span> @enderror

                <label class="admin-form-label" style="margin-top:1.25rem;">Deskripsi <span class="required">*</span></label>
                <textarea name="description" rows="5" placeholder="Jelaskan tujuan dan kegiatan utama ekstrakurikuler ini...">{{ old('description', $ekskul->description ?? '') }}</textarea>
                @error('description') <span class="form-error">{{ $message }}</span> @enderror

                <label class="admin-form-label" style="margin-top:1.25rem;">Status Program</label>
                <div class="admin-radio-group">
                    <label class="admin-radio-option">
                        <input type="radio" name="status" value="aktif" {{ old('status', $ekskul->status ?? 'aktif') == 'aktif' ? 'checked' : '' }}>
                        Aktif
                    </label>
                    <label class="admin-radio-option">
                        <input type="radio" name="status" value="nonaktif" {{ old('status', $ekskul->status ?? '') == 'nonaktif' ? 'checked' : '' }}>
                        Tidak Aktif
                    </label>
                </div>

                <hr class="admin-form-divider">

                <div class="admin-form-actions">
                    <a href="{{ route('admin.ekstrakurikuler.index') }}" class="btn btn-outline">Batal</a>
                    <button type="submit" class="btn btn-navy">
                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px;vertical-align:-2px;"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Simpan Program
                    </button>
                </div>
            </div>

        </div>
    </form>

@endsection

@section('scripts')
<script>
    const fotoInput = document.getElementById('fotoEkskul');
    const previewImg = document.getElementById('previewImg');
    const placeholder = document.getElementById('uploadPlaceholder');

    fotoInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
                placeholder.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection