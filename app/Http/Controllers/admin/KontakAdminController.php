<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;
use App\Support\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KontakAdminController extends Controller
{
    const TAG_DIIZINKAN = '<b><strong><i><em><u><br><p><a><ul><ol><li><div>';

    public function index(Request $request)
    {
        $query = PesanKontak::query();

        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('nama', 'like', '%' . $keyword . '%')
                  ->orWhere('subjek', 'like', '%' . $keyword . '%');
            });
        }

        $allPesan = $query->orderByDesc('created_at')->get();

        $totalPesan = PesanKontak::count();
        $belumDibaca = PesanKontak::where('sudah_dibaca', false)->count();

        $perPage = 6;
        $currentPage = (int) $request->query('page', 1);
        $totalPages = max(1, (int) ceil($allPesan->count() / $perPage));
        $paged = $allPesan->forPage($currentPage, $perPage)->values();

        return view('admin.kontak.index', [
            'pesanList' => $paged,
            'totalPesan' => $totalPesan,
            'belumDibaca' => $belumDibaca,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'search' => $request->search,
            'startNumber' => ($currentPage - 1) * $perPage,
            'totalData' => $allPesan->count(),
        ]);
    }

    public function show($id)
    {
        $pesan = PesanKontak::findOrFail($id);
        $pesan->update(['sudah_dibaca' => true]);

        return view('admin.kontak.show', compact('pesan'));
    }

    public function saveDraft(Request $request, $id)
    {
        $pesan = PesanKontak::findOrFail($id);

        $pesan->update([
            'balasan_draft' => strip_tags($request->input('isi_balasan', ''), self::TAG_DIIZINKAN),
        ]);

        return redirect()->route('admin.kontak.show', $id)->with('success', 'Draft balasan disimpan.');
    }

    public function balas(Request $request, $id)
    {
        $pesan = PesanKontak::findOrFail($id);

        $data = $request->validate([
            'subjek_balasan' => 'required|string|max:255',
            'isi_balasan' => 'required|string',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        $isi = strip_tags($data['isi_balasan'], self::TAG_DIIZINKAN);

        $path = null;
        $namaAsli = null;
        if ($request->hasFile('lampiran')) {
            $namaAsli = $request->file('lampiran')->getClientOriginalName();
            $path = $request->file('lampiran')->store('lampiran_balasan');
        }

        $pesan->update([
            'balasan' => $isi,
            'balasan_draft' => null,
            'dibalas_pada' => now(),
            'lampiran_balasan' => $path,
            'lampiran_balasan_nama' => $namaAsli,
        ]);

        ActivityLogger::log('created', 'Pesan Kontak Dibalas', 'Balasan untuk "' . $pesan->nama . '" (' . $pesan->email . ')', 'siswa-baru');

        return redirect()->route('admin.kontak.index')->with('success', 'Balasan berhasil disimpan untuk ' . $pesan->email);
    }

    public function unduhLampiran($id)
    {
        $pesan = PesanKontak::findOrFail($id);

        abort_if(!$pesan->lampiran_balasan || !Storage::exists($pesan->lampiran_balasan), 404);

        return Storage::download($pesan->lampiran_balasan, $pesan->lampiran_balasan_nama);
    }

    public function destroy($id)
    {
        $pesan = PesanKontak::findOrFail($id);

        if ($pesan->lampiran_balasan) {
            Storage::delete($pesan->lampiran_balasan);
        }

        $nama = $pesan->nama;
        $pesan->delete();

        ActivityLogger::log('deleted', 'Pesan Kontak Dihapus', 'Pesan dari "' . $nama . '"');

        return redirect()->route('admin.kontak.index')->with('success', 'Pesan berhasil dihapus.');
    }
}