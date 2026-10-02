@extends('layouts.admin')

@section('title', 'Detail & Balas Pesan - Admin Panel')
@section('page-title', 'Detail & Balas Pesan')

@section('content')

    @if (session('success'))
        <div class="admin-toast" id="adminToast">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="admin-toast admin-toast-error" id="adminToast">{{ session('error') }}</div>
    @endif

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Detail &amp; Balas Pesan</h1>
            <div class="admin-breadcrumb-inline">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>&rsaquo;</span>
                <a href="{{ route('admin.kontak.index') }}">Pesan Masuk</a>
                <span>&rsaquo;</span>
                <strong>ID #{{ $pesan->kode }}</strong>
            </div>
        </div>
        <a href="{{ route('admin.kontak.index') }}" class="admin-back-btn">&larr; Kembali ke Daftar Pesan</a>
    </div>

    <div class="reply-layout">

        {{-- ===== KIRI: PESAN MASUK ===== --}}
        <div class="reply-card">
            <div class="reply-card-head">
                <span class="reply-label">PESAN MASUK</span>
                @if ($pesan->dibalas_pada)
                    <span class="admin-badge-publish">Sudah Dibalas</span>
                @else
                    <span class="admin-badge-publish">Dibaca</span>
                @endif
            </div>

            <div class="reply-sender">
                <div class="reply-avatar">{{ $pesan->inisial }}</div>
                <div>
                    <strong>{{ $pesan->nama }}</strong>
                    <span>{{ $pesan->email }}</span>
                    <small>{{ $pesan->tanggal }} WIB</small>
                </div>
            </div>

            <span class="reply-label">SUBJEK</span>
            <div class="reply-subject-box">{{ $pesan->subjek }}</div>

            <span class="reply-label">ISI PESAN</span>
            <div class="reply-message-box">{{ $pesan->pesan }}</div>

            @if ($pesan->dibalas_pada)
                <div class="reply-sent-note">
                    Dibalas pada {{ $pesan->dibalas_pada->translatedFormat('d F Y, H:i') }}
                </div>

                <span class="reply-label">BALASAN TERKIRIM</span>
                <div class="reply-message-box">{!! $pesan->balasan !!}</div>

                @if ($pesan->lampiran_balasan)
                    <a href="{{ route('admin.kontak.unduh-lampiran', $pesan->id) }}" style="display:inline-flex; align-items:center; gap:0.4rem; margin-top:0.5rem; font-size:0.85rem; font-weight:600; color:var(--navy-900);">
                        &#128206; {{ $pesan->lampiran_balasan_nama }}
                    </a>
                @endif
            @endif

            <div class="reply-card-foot">
                <span>IP: {{ $pesan->ip_address ?? '-' }}</span>
                <form action="{{ route('admin.kontak.destroy', $pesan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesan ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="reply-delete">Hapus Pesan</button>
                </form>
            </div>
        </div>

        {{-- ===== KANAN: FORMULIR BALAS ===== --}}
        <div class="reply-card">
            <div class="reply-card-head">
                <div>
                    <h2 class="reply-title">Formulir Balas Pesan</h2>
                    <p class="reply-desc">Kirim tanggapan langsung ke surel pengirim melalui server SMTP sekolah.</p>
                </div>
                <span class="reply-mailer-badge">Official Mailer</span>
            </div>

            <form action="{{ route('admin.kontak.balas', $pesan->id) }}" method="POST" enctype="multipart/form-data" id="replyForm">
                @csrf

                <div class="reply-row">
                    <div>
                        <label class="reply-label">Penerima (To)</label>
                        <div class="reply-locked">{{ $pesan->email }} <span>Terkunci</span></div>
                    </div>
                    <div>
                        <label class="reply-label">Kirim Sebagai (From)</label>
                        <div class="reply-locked">Humas &amp; Informasi SMKN 4 Bogor<br>&lt;{{ config('mail.from.address') }}&gt;</div>
                    </div>
                </div>

                <label class="reply-label">Subjek Email Balasan</label>
                <input type="text" name="subjek_balasan" class="reply-input"
                       value="{{ old('subjek_balasan', 'Re: ' . $pesan->subjek) }}">
                @error('subjek_balasan') <span class="form-error">{{ $message }}</span> @enderror

                <label class="reply-label">Isi Pesan Balasan</label>
                <div class="reply-editor">
                    <div class="reply-toolbar">
                        <button type="button" data-cmd="bold"><b>B</b></button>
                        <button type="button" data-cmd="italic"><i>I</i></button>
                        <button type="button" data-cmd="underline"><u>U</u></button>
                        <button type="button" data-cmd="insertUnorderedList">&#8801;</button>
                        <button type="button" data-cmd="createLink">&#128279;</button>
                        <span class="reply-toolbar-note">Format HTML Didukung</span>
                    </div>
                    <div class="reply-editable" id="editable" contenteditable="true">{!! old('isi_balasan', $pesan->balasan_draft ?? '<p>Yth. Sdr. ' . e($pesan->nama) . ',</p><p>Terima kasih telah menghubungi SMKN 4 Kota Bogor.</p><p><br></p><p>Hormat kami,<br>Humas SMKN 4 Kota Bogor</p>') !!}</div>
                    <textarea name="isi_balasan" id="isiBalasan" hidden></textarea>
                </div>
                @error('isi_balasan') <span class="form-error">{{ $message }}</span> @enderror

                <label class="reply-attach" for="lampiran">
                    <span class="reply-attach-icon">FILE</span>
                    <div>
                        <strong id="attachName">Belum ada lampiran</strong>
                        <small>Opsional · PDF, DOC, JPG, PNG · maks. 5 MB</small>
                    </div>
                    <span class="reply-attach-link">+ Pilih File</span>
                </label>
                <input type="file" name="lampiran" id="lampiran" hidden accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                @error('lampiran') <span class="form-error">{{ $message }}</span> @enderror

                <div class="reply-actions">
                    <div>
                        <button type="submit" formaction="{{ route('admin.kontak.draft', $pesan->id) }}" class="reply-btn-outline">Simpan Draft</button>
                        <a href="{{ route('admin.kontak.index') }}" class="reply-btn-cancel">Batal</a>
                    </div>
                    <button type="submit" class="reply-btn-send">Kirim Balasan Sekarang</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    const editable = document.getElementById('editable');
    const hidden = document.getElementById('isiBalasan');
    const form = document.getElementById('replyForm');

    // Toolbar B / I / U / list / link
    document.querySelectorAll('.reply-toolbar button').forEach(btn => {
        btn.addEventListener('click', () => {
            const cmd = btn.dataset.cmd;
            editable.focus();
            if (cmd === 'createLink') {
                const url = prompt('Masukkan alamat link (https://...)');
                if (url) document.execCommand('createLink', false, url);
            } else {
                document.execCommand(cmd, false, null);
            }
        });
    });

    // Salin isi editor ke textarea tersembunyi sebelum form dikirim
    form.addEventListener('submit', () => { hidden.value = editable.innerHTML; });

    // Tampilkan nama file lampiran
    document.getElementById('lampiran').addEventListener('change', function () {
        document.getElementById('attachName').textContent = this.files[0] ? this.files[0].name : 'Belum ada lampiran';
    });

    const toast = document.getElementById('adminToast');
    if (toast) setTimeout(() => toast.style.display = 'none', 4000);
</script>
@endsection