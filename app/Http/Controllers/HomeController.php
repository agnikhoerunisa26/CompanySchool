<?php

namespace App\Http\Controllers;
use App\Models\Artikel;

class HomeController extends Controller
{
    public function index()
    {
        // Data 4 kartu fitur (Guru Profesional, Fasilitas Lengkap, dst)
        $features = [
            [
                'icon' => 'guru',
                'title' => 'Guru Profesional',
                'description' => 'Didukung tenaga pendidik yang profesional, kompeten, dan berpengalaman di bidangnya.',
            ],
            [
                'icon' => 'fasilitas',
                'title' => 'Fasilitas Lengkap',
                'description' => 'Dilengkapi laboratorium komputer, bengkel praktik, ruang belajar, dan sarana penunjang yang memadai.',
            ],
            [
                'icon' => 'prestasi',
                'title' => 'Prestasi Membanggakan',
                'description' => 'Berbagai prestasi akademik maupun nonakademik di tingkat kota, provinsi, hingga nasional.',
            ],
            [
                'icon' => 'lingkungan',
                'title' => 'Lingkungan Nyaman',
                'description' => 'Lingkungan belajar yang bersih, aman, nyaman, dan kondusif untuk mendukung proses belajar mengajar.',
            ],
        ];

        // Data artikel terbaru - diambil dari 3 artikel pertama halaman Artikel
       $articles = Artikel::where('status', 'publish')->orderByDesc('published_date')->take(3)->get();

        // Data program keahlian (nanti diganti: ProgramKeahlian::all())
        $programs = [
            ['name' => 'PPLG', 'full' => 'Pengembangan Perangkat Lunak dan Gim', 'description' => 'Mempelajari pemrograman, pengembangan aplikasi/mobile, basis data, dan gim.', 'image' => 'pplg.jpg', 'logo' => 'logopplg.png'],
            ['name' => 'TKJ', 'full' => 'Teknik Komputer & Jaringan', 'description' => 'Mempelajari instalasi jaringan administrasi server, dan keamanan jaringan.', 'image' => 'tkj.JPG', 'logo' => 'logotkj.png'],
            ['name' => 'TPFL', 'full' => 'Teknik Pengelasan Fabrikasi Logam', 'description' => 'Mempelajari teknik Pengelasan, fabrikasi logam, gambar teknik, dan K3.', 'image' => 'tpfl.jpg', 'logo' => 'logotp.png'],
            ['name' => 'TO', 'full' => 'Teknik Otomotif', 'description' => 'Mempelajari perawatan, perbaikan, dan diagnosa kendaraan serta teknologi.', 'image' => 'to.JPG', 'logo' => 'logoto.png'],
        ];

        // Data ekstrakurikuler unggulan (nanti diganti: Ekstrakurikuler::where('unggulan', true)->get())
        $ekskuls = [
            ['name' => 'Pramuka', 'logo' => 'logopramuka.png'],
            ['name' => 'PMR', 'logo' => 'logopmr.png'],
            ['name' => 'Paskibra', 'logo' => 'logopaskib.png'],
            ['name' => 'Rohis', 'logo' => 'logorohis.png'],
            ['name' => 'Futsal', 'logo' => 'logofutsal.png'],
            ['name' => 'Basket', 'logo' => 'logobasket.png'],
        ];

        return view('home', compact('features', 'articles', 'programs', 'ekskuls'));
    }
}