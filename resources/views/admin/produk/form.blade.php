@extends('layouts.admin')

@section('title', $formTitle . ' - Admin Panel')
@section('page-title', 'Daftar Produk')

@section('content')

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">{{ $formTitle }}</h1>
            <div class="admin-breadcrumb-inline">
                <a href="{{ route('admin.dashboard') }}">Admin</a>
                <span>&rsaquo;</span>
                <a href="{{ route('admin.produk.index') }}">Daftar Produk</a>
                <span>&rsaquo;</span>
                <strong>{{ $product ? 'Edit Produk' : 'Tambah Produk' }}</strong>
            </div>
        </div>
        <a href="{{ route('admin.produk.index') }}" class="admin-back-btn">&larr; Kembali ke Daftar</a>
    </div>

    <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data" id="produkForm">
        @csrf
        @if ($product)
            @method('PUT')
        @endif

        <div class="produk-form-layout">

            {{-- ===== KIRI: FOTO + VISIBILITAS ===== --}}
            <div class="produk-form-col">
                <div class="reply-card">
                    <div class="produk-form-card-head">
                        <div>
                            <h3>Foto Produk</h3>
                            <p>Unggah foto utama etalase produk</p>
                        </div>
                        <span class="produk-badge-wajib">Wajib</span>
                    </div>

                    <label for="fotoProduk" class="produk-upload-box" id="uploadBox">
                        <img id="previewImg"
                             src="{{ $product ? asset('images/' . $product->image) : '' }}"
                             style="{{ $product ? '' : 'display:none;' }}"
                             alt="Preview">
                        <div id="uploadPlaceholder" style="{{ $product ? 'display:none;' : '' }}">
                            <span class="produk-upload-icon">
                                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                            </span>
                            <strong>Klik atau seret gambar ke sini</strong>
                            <span>Format PNG, JPG atau WebP</span>
                            <span class="produk-upload-max">Maksimal ukuran 5MB</span>
                        </div>
                    </label>
                    <input type="file" name="foto" id="fotoProduk" accept="image/png, image/jpeg, image/webp" style="display:none;" {{ $product ? '' : 'required' }}>
                    @error('foto') <span class="form-error">{{ $message }}</span> @enderror

                    <div class="produk-hint-box">
                        <span>&#8505;</span>
                        <p>Gunakan foto produk dengan resolusi minimal <strong>800 x 800 px</strong> dengan pencahayaan terang dan latar belakang rapi.</p>
                    </div>
                </div>

                <div class="reply-card">
                    <h3 class="produk-visibilitas-title">Visibilitas Produk</h3>
                    <div class="produk-toggle-row">
                        <div>
                            <strong>Status Publikasi</strong>
                            <p>Tampilkan produk langsung di etalase</p>
                        </div>
                        <label class="produk-switch">
                            <input type="checkbox" name="is_published" value="1" {{ old('is_published', !$product || $product->status === 'publish') ? 'checked' : '' }}>
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- ===== KANAN: INFORMASI DETAIL ===== --}}
            <div class="reply-card produk-form-col-main">
                <h3>Informasi Detail Produk</h3>
                <p class="produk-form-desc">Lengkapi spesifikasi produk kreatif SMKN 4 Bogor.</p>

                <label class="admin-form-label">Nama Produk <span class="required">*</span></label>
                <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" placeholder="Masukkan nama produk...">
                @error('name') <span class="form-error">{{ $message }}</span> @enderror

                <label class="admin-form-label" style="margin-top:1.25rem;">Kategori <span class="required">*</span></label>
                <select name="kategori">
                    <option value="" disabled {{ old('kategori', $product->kategori ?? '') ? '' : 'selected' }}>Pilih Kategori</option>
                    <option value="Seragam" {{ old('kategori', $product->kategori ?? '') == 'Seragam' ? 'selected' : '' }}>Seragam</option>
                    <option value="Atribut (bet sekolah)" {{ old('kategori', $product->kategori ?? '') == 'Atribut (bet sekolah)' ? 'selected' : '' }}>Atribut (bet sekolah)</option>
                    <option value="Atribut (topi dan sabuk sekolah)" {{ old('kategori', $product->kategori ?? '') == 'Atribut (topi dan sabuk sekolah)' ? 'selected' : '' }}>Atribut (topi dan sabuk sekolah)</option>
                </select>
                @error('kategori') <span class="form-error">{{ $message }}</span> @enderror

                <div class="admin-form-row-2" style="margin-top:1.25rem;">
                    <div>
                        <label class="admin-form-label">Harga (IDR) <span class="required">*</span></label>
                        <div class="admin-input-prefix">
                            <span>Rp</span>
                            <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" placeholder="0" min="0">
                        </div>
                        @error('price') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="admin-form-label">Stok (Unit) <span class="required">*</span></label>
                        <input type="number" name="stok" value="{{ old('stok', $product->stok ?? '') }}" placeholder="0" min="0">
                        @error('stok') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="produk-desc-head" style="margin-top:1.25rem;">
                    <label class="admin-form-label" style="margin-bottom:0;">Deskripsi Produk <span class="required">*</span></label>
                    <span class="produk-desc-max">Maksimal 1500 karakter</span>
                </div>
                <div class="admin-editor-toolbar">
                    <button type="button"><b>B</b></button>
                    <button type="button"><i>I</i></button>
                    <button type="button"><u>U</u></button>
                    <button type="button">&#8801;</button>
                    <button type="button">&#128279;</button>
                </div>
                <textarea name="deskripsi" rows="6" maxlength="1500" class="admin-editor-textarea" placeholder="Tuliskan deskripsi lengkap mengenai produk ini...">{{ old('deskripsi', $product->deskripsi ?? '') }}</textarea>
                @error('deskripsi') <span class="form-error">{{ $message }}</span> @enderror

                <hr class="admin-form-divider">

                <div class="admin-form-actions">
                    <a href="{{ route('admin.produk.index') }}" class="btn btn-outline">Batal</a>
                    <button type="submit" name="action" value="draft" class="btn btn-outline">Simpan Draft</button>
                    <button type="submit" name="action" value="publish" class="btn btn-navy">
                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px;vertical-align:-2px;"><polyline points="20 6 9 17 4 12"/></svg>
                        Simpan Produk
                    </button>
                </div>
            </div>

        </div>
    </form>

@endsection

@section('scripts')
<script>
    const fotoInput = document.getElementById('fotoProduk');
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