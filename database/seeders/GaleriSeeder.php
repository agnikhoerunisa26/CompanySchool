<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $allPhotos = [
            ['image' => 'galeri2.png', 'kategori' => 'Prestasi', 'caption' => 'Penyerahan Penghargaan'],
            ['image' => 'galeri3.jpg', 'kategori' => 'Kegiatan', 'caption' => 'Kegiatan Ekstrakurikuler'],
            ['image' => 'galeri4.jpeg', 'kategori' => 'Kegiatan', 'caption' => 'Tari Tradisional'],
            ['image' => 'galeri5.JPG', 'kategori' => 'Kegiatan', 'caption' => 'Upacara Bendera'],
            ['image' => 'galeri6.JPG', 'kategori' => 'Kegiatan', 'caption' => 'Upacara Peringatan'],
            ['image' => 'galeri7.JPG', 'kategori' => 'Fasilitas', 'caption' => 'Fasilitas Sekolah'],
        ];

        $prestasi = [
            ['image' => 'prestasi1.webp', 'caption' => 'Salma - Juara 2 Tanding Putri Kelas B, Cabang Pencak Silat'],
            ['image' => 'prestasi2.webp', 'caption' => 'Melati - Juara 2 Tanding Putri Kelas A, Cabang Pencak Silat'],
            ['image' => 'prestasi3.webp', 'caption' => 'Mawar - Juara 1 Regu Putri, Cabang Pencak Silat'],
            ['image' => 'prestasi4.webp', 'caption' => 'Justine - Juara 3 LKS Tingkat Kota Bidang Keahlian'],
            ['image' => 'prestasi5.webp', 'caption' => 'Novandra - Juara 1 LKS Tingkat Kota Bidang Keahlian'],
            ['image' => 'prestasi6.webp', 'caption' => 'Fadilah - Juara 1 LKS Tingkat Kota Bidang Keahlian'],
            ['image' => 'prestasi7.webp', 'caption' => 'Penyerahan Penghargaan Kepada Para Siswa Berprestasi'],
            ['image' => 'prestasi8.jpg', 'caption' => 'Penyerahan Penghargaan Kepada Siswa Berprestasi'],
            ['image' => 'prestasi9.jpg', 'caption' => 'Penyerahan Penghargaan Kepada Siswa Berprestasi'],
        ];

        $kegiatan = [
            ['image' => 'kegiatan1.webp', 'caption' => 'Kegiatan Bermain Congklak'],
            ['image' => 'kegiatan2.webp', 'caption' => 'Kegiatan Silat'],
            ['image' => 'kegiatan3.webp', 'caption' => 'Kegiatan Musik'],
            ['image' => 'kegiatan4.webp', 'caption' => 'Kegiatan Tari Tradisional'],
            ['image' => 'kegiatan5.webp', 'caption' => 'Kegiatan Belajar Mengajar'],
            ['image' => 'kegiatan6.webp', 'caption' => 'Kegiatan Pentas Seni'],
            ['image' => 'kegiatan7.jpg', 'caption' => 'Kegiatan Belajar Mengajar'],
            ['image' => 'kegiatan8.webp', 'caption' => 'Kegiatan Kerohanian'],
            ['image' => 'kegiatan9.webp', 'caption' => 'Kegiatan Sekolah'],
        ];

        $fasilitas = [
            ['image' => 'fasilitas1.JPG', 'caption' => 'Lapangan Basket'],
            ['image' => 'fasilitas2.webp', 'caption' => 'Aula Sekolah'],
            ['image' => 'fasilitas3.JPG', 'caption' => 'Ruang Teknik Komputer dan Jaringan'],
            ['image' => 'fasilitas4.JPG', 'caption' => 'Gedung RPL'],
            ['image' => 'fasilitas5.JPG', 'caption' => 'Gedung Sekolah'],
            ['image' => 'fasilitas6.webp', 'caption' => 'Laboratorium Komputer'],
            ['image' => 'fasilitas7.webp', 'caption' => 'Ruang Pertemuan'],
            ['image' => 'fasilitas8.png', 'caption' => 'Bengkel Praktik Otomotif'],
            ['image' => 'fasilitas9.webp', 'caption' => 'Ruang Kelas'],
        ];

        $gabung = collect($allPhotos)
            ->concat(collect($prestasi)->map(fn($p) => $p + ['kategori' => 'Prestasi']))
            ->concat(collect($kegiatan)->map(fn($p) => $p + ['kategori' => 'Kegiatan']))
            ->concat(collect($fasilitas)->map(fn($p) => $p + ['kategori' => 'Fasilitas']))
            ->values();

        foreach ($gabung as $index => $item) {
            Galeri::create([
                'image' => $item['image'],
                'kategori' => $item['kategori'],
                'caption' => $item['caption'],
                'tanggal_media' => Carbon::now()->subDays($index * 3)->format('Y-m-d'),
            ]);
        }
    }
}