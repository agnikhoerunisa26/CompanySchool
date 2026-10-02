<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Support\ActivityLogger;
use Illuminate\Http\Request;

class GaleriAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::query();

        $kategoriAktif = $request->query('kategori', 'semua');
        if ($kategoriAktif !== 'semua') {
            $query->where('kategori', $kategoriAktif);
        }

        $totalMedia = Galeri::count();
        $totalFoto = $totalMedia;
        $totalKategori = Galeri::distinct()->pluck('kategori')->count();

        $perPage = 6;
        $currentPage = (int) $request->query('page', 1);
        $all = $query->orderByDesc('tanggal_media')->get();
        $totalPages = max(1, (int) ceil($all->count() / $perPage));
        $paged = $all->forPage($currentPage, $perPage)->map(function ($g) {
            $g->tanggal = $g->tanggal_media ? \Carbon\Carbon::parse($g->tanggal_media)->translatedFormat('d M Y') : '-';
            return $g;
        })->values();

        return view('admin.galeri.index', [
            'galeris' => $paged,
            'totalMedia' => $totalMedia,
            'totalFoto' => $totalFoto,
            'totalKategori' => $totalKategori,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'kategoriAktif' => $kategoriAktif,
            'startNumber' => ($currentPage - 1) * $perPage,
            'totalData' => $all->count(),
        ]);
    }

    public function create()
    {
        return view('admin.galeri.form', [
            'galeri' => null,
            'formAction' => route('admin.galeri.store'),
            'formTitle' => 'Tambah Media Galeri Baru',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'foto' => 'required|image|max:10240',
            'kategori' => 'required|string',
            'tanggal_media' => 'required|date',
        ]);

        $file = $request->file('foto');
        $imageName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $imageName);

        $galeri = Galeri::create([
            'image' => $imageName,
            'kategori' => $data['kategori'],
            'tanggal_media' => $data['tanggal_media'],
        ]);

        ActivityLogger::log('created', 'Media Galeri Ditambahkan', 'Kategori ' . $galeri->kategori);

        return redirect()->route('admin.galeri.index')->with('success', 'Data galeri berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);

        return view('admin.galeri.form', [
            'galeri' => $galeri,
            'formAction' => route('admin.galeri.update', $galeri->id),
            'formTitle' => 'Edit Media Galeri',
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'foto' => 'nullable|image|max:10240',
            'kategori' => 'required|string',
            'tanggal_media' => 'required|date',
        ]);

        $galeri = Galeri::findOrFail($id);

        $updateData = [
            'kategori' => $data['kategori'],
            'tanggal_media' => $data['tanggal_media'],
        ];

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $imageName);
            $updateData['image'] = $imageName;
        }

        $galeri->update($updateData);

        ActivityLogger::log('updated', 'Media Galeri Diperbarui', 'Kategori ' . $galeri->kategori);

        return redirect()->route('admin.galeri.index')->with('success', 'Data galeri berhasil diperbarui ke server.');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        $kategori = $galeri->kategori;
        $galeri->delete();

        ActivityLogger::log('deleted', 'Media Galeri Dihapus', 'Kategori ' . $kategori);

        return redirect()->route('admin.galeri.index')->with('success', 'Berhasil menghapus media galeri.');
    }
}