<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Produk;
use App\Models\Ekstrakurikuler;
use App\Http\Controllers\Admin\GaleriAdminController;
use App\Support\ActivityLogger;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $totalArtikel = Artikel::count();

        $totalProduk = Produk::count();

        $totalEkskul = Ekstrakurikuler::count();
        $ekskulAktif = Ekstrakurikuler::where('status', 'aktif')->count();

       $totalGaleri = \App\Models\Galeri::count();
        $stats = [
            ['label' => 'Total Artikel', 'value' => $totalArtikel, 'note' => 'Data saat ini', 'trend' => 'up', 'icon' => 'artikel'],
            ['label' => 'Total Produk', 'value' => $totalProduk, 'note' => 'Data saat ini', 'trend' => 'flat', 'icon' => 'produk'],
            ['label' => 'Ekstrakurikuler', 'value' => $totalEkskul, 'note' => $ekskulAktif . ' Aktif', 'trend' => 'ok', 'icon' => 'ekskul'],
            ['label' => 'Total Galeri', 'value' => $totalGaleri, 'note' => 'Data saat ini', 'trend' => 'up', 'icon' => 'galeri'],
        ];

        $activities = ActivityLogger::latest(5);

        if ($activities->isEmpty()) {
            $activities = $this->dummyActivities();
        }

        return view('admin.dashboard', compact('stats', 'activities'));
    }

    public function aktivitas()
    {
        $activities = ActivityLogger::latest(20);

        if ($activities->isEmpty()) {
            $activities = $this->dummyActivities();
        }

        return view('admin.aktivitas.index', compact('activities'));
    }

    private function dummyActivities()
    {
        return collect([
            [
                'icon' => 'artikel-baru',
                'title' => 'Artikel Baru Ditambahkan',
                'desc' => '"Siswa SMK Negeri 4 Kota Bogor Raih Juara 1 LKS Tingkat Kota"',
                'time' => '2 Jam yang lalu',
            ],
            [
                'icon' => 'produk-update',
                'title' => 'Produk Diperbarui',
                'desc' => 'Stok "Seragam Batik SMKN 4 Bogor" diperbarui.',
                'time' => '5 Jam yang lalu',
            ],
            
            [
                'icon' => 'siswa-baru',
                'title' => 'Ekstrakurikuler Baru Ditambahkan',
                'desc' => 'Program ekstrakurikuler baru berhasil ditambahkan.',
                'time' => 'Kemarin, 09:00',
            ],
            [
                'icon' => 'sistem-update',
                'title' => 'Sistem Update',
                'desc' => 'Update konfigurasi logo sekolah.',
                'time' => '2 Hari yang lalu',
            ],
        ]);
    }
}