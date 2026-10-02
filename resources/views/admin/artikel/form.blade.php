@extends('layouts.admin')

@section('title', $formTitle . ' - Admin Panel')
@section('page-title', 'Daftar Artikel')

@section('content')

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">{{ $formTitle }}</h1>
            <div class="admin-breadcrumb-inline">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>&rsaquo;</span>
                <a href="{{ route('admin.artikel.index') }}">Daftar Artikel</a>
                <span>&rsaquo;</span>
                <strong>{{ $article ? 'Edit Artikel' : 'Tambah Artikel' }}</strong>
            </div>
        </div>
    </div>

    <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($article)
            @method('PUT')
        @endif

        <div class="produk-form-layout">

            {{-- ===== KIRI: FOTO SAMPUL ===== --}}
            <div class="produk-form-col">
                <div class="reply-card">
                    <div class="produk-form-card-head">
                        <div>
                            <h3>Foto Sampul</h3>
                            <p>Unggah gambar sampul artikel</p>
                        </div>
                    </div>

                    <label for="fotoSampul" class="produk-upload-box" id="uploadBox">
                        <img id="previewImg"
                             src="{{ $article ? asset('images/' . $article['image']) : '' }}"
                             style="{{ $article ? '' : 'display:none;' }}"
                             alt="Preview">
                        <div id="uploadPlaceholder" style="{{ $article ? 'display:none;' : '' }}">
                            <span class="produk-upload-icon">
                                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="M21 15l-5-5L5 21"/></svg>
                            </span>
                            <strong>Klik atau seret gambar ke sini</strong>
                            <span>Format PNG atau JPG</span>
                            <span class="produk-upload-max">Maksimal ukuran 5MB</span>
                        </div>
                    </label>
                    <input type="file" name="foto_sampul" id="fotoSampul" accept="image/png, image/jpeg" style="display:none;">
                </div>
            </div>

            {{-- ===== KANAN: INFORMASI ARTIKEL ===== --}}
            <div class="reply-card produk-form-col-main">
                <h3>Informasi Artikel</h3>
                <p class="produk-form-desc">Lengkapi judul, tanggal, dan status publikasi artikel.</p>

                <label class="admin-form-label">Judul Artikel <span class="required">*</span></label>
                <input type="text" name="title" value="{{ old('title', $article['title'] ?? '') }}" placeholder="Masukkan judul artikel yang menarik...">
                @error('title') <span class="form-error">{{ $message }}</span> @enderror

                <div class="admin-form-row-2" style="margin-top:1.25rem;">
                    <div>
                        <label class="admin-form-label">Tanggal Publish</label>
                        <input type="date" name="publish_date" value="{{ old('publish_date', $article['date_raw'] ?? '') }}">
                    </div>
                    <div>
                        <label class="admin-form-label">Status Publikasi</label>
                        <select name="status">
                            <option value="publish" {{ old('status', $article['status'] ?? 'publish') == 'publish' ? 'selected' : '' }}>Publish</option>
                            <option value="draft" {{ old('status', $article['status'] ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                </div>

                <hr class="admin-form-divider">

                <label class="admin-form-label">Konten Artikel <span class="required">*</span></label>
                <div class="admin-editor-toolbar">
                    <button type="button"><strong>B</strong></button>
                    <button type="button"><em>I</em></button>
                    <button type="button"><u>U</u></button>
                    <button type="button">
                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                    </button>
                    <button type="button">
                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><line x1="10" y1="6" x2="21" y2="6"/><line x1="10" y1="12" x2="21" y2="12"/><line x1="10" y1="18" x2="21" y2="18"/><path d="M4 6h1v4"/><path d="M4 10h2"/><path d="M6 18H4c0-1 2-2 2-3s-1-1.5-2-1"/></svg>
                    </button>
                    <span class="admin-editor-divider"></span>
                    <button type="button">
                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                    </button>
                    <button type="button">
                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                    </button>
                </div>
                <textarea name="content" rows="10" class="admin-editor-textarea" placeholder="Tulis isi artikel di sini...">{{ old('content', $article['content'] ?? '') }}</textarea>
                @error('content') <span class="form-error">{{ $message }}</span> @enderror

                <hr class="admin-form-divider">

                <div class="admin-form-actions">
                    <a href="{{ route('admin.artikel.index') }}" class="btn btn-outline">Batal</a>
                    <button type="submit" class="btn btn-navy">
                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px;vertical-align:-2px;"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Simpan Artikel
                    </button>
                </div>
            </div>

        </div>
    </form>

@endsection

@section('scripts')
<script>
    const fotoInput = document.getElementById('fotoSampul');
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