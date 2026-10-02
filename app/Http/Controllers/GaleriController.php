<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $kategori = strtolower($request->query('kategori', 'semua'));
        $useGrid3 = in_array($kategori, ['prestasi', 'kegiatan', 'fasilitas']);

        $query = Galeri::query();

        if ($useGrid3) {
            $query->whereRaw('LOWER(kategori) = ?', [$kategori]);
        }

        $query->orderByDesc('tanggal_media')->orderByDesc('id');

        // Tab "Semua" dibatasi 24 foto terbaru (4 halaman x 6 foto), kategori lain menampilkan semuanya
        if (!$useGrid3) {
            $query->limit(24);
        }

        $perPage = $useGrid3 ? 9 : 6;
        $currentPage = (int) $request->query('page', 1);
        $all = $query->get();
        $totalPages = max(1, (int) ceil($all->count() / $perPage));
        $photos = $all->forPage($currentPage, $perPage)->values();

        return view('galeri', compact('photos', 'kategori', 'useGrid3', 'currentPage', 'totalPages'));
    }
}