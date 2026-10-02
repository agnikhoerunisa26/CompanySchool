<?php

namespace Database\Seeders;

use App\Models\Ekstrakurikuler;
use Illuminate\Database\Seeder;

class EkstrakurikulerSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Pramuka', 'image' => 'eskul2.JPG', 'description' => 'Pramuka adalah kegiatan ekstrakurikuler yang bertujuan membentuk karakter, kedisiplinan, kemandirian, serta jiwa kepemimpinan peserta didik melalui berbagai kegiatan kepramukaan.', 'status' => 'aktif'],
            ['name' => 'PMR', 'image' => 'eskul3.JPG', 'description' => 'PMR adalah kegiatan ekstrakurikuler yang berfokus pada pengembangan kepedulian sosial, keterampilan pertolongan pertama, serta semangat kemanusiaan.', 'status' => 'aktif'],
            ['name' => 'Paskibra', 'image' => 'eskul4.JPG', 'description' => 'Paskibra adalah kegiatan ekstrakurikuler yang bertujuan melatih kedisiplinan, tanggung jawab, kepemimpinan, dan kekompakan melalui kegiatan baris-berbaris.', 'status' => 'aktif'],
            ['name' => 'Rohis', 'image' => 'eskul5.JPG', 'description' => 'Rohis adalah kegiatan ekstrakurikuler yang bertujuan membina karakter religius, memperdalam pengetahuan keagamaan, serta menumbuhkan akhlak mulia.', 'status' => 'aktif'],
            ['name' => 'Futsal', 'image' => 'eskul7.JPG', 'description' => 'Futsal adalah kegiatan ekstrakurikuler yang melatih keterampilan bermain futsal, meningkatkan kebugaran jasmani, serta membangun kerja sama tim dan sportivitas.', 'status' => 'aktif'],
            ['name' => 'Basket', 'image' => 'eskul6.JPG', 'description' => 'Basket adalah kegiatan ekstrakurikuler yang mengembangkan kemampuan bermain bola basket, sportivitas, kerja sama tim, dan semangat berkompetisi.', 'status' => 'aktif'],
        ];

        foreach ($data as $item) {
            Ekstrakurikuler::create($item);
        }
    }
}