<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Seragam Muslim SMKN 4 Bogor', 'kategori' => 'Seragam', 'price' => 150000, 'stok' => 25, 'image' => 'seragam1.jpeg'],
            ['name' => 'Seragam Batik SMKN 4 Bogor', 'kategori' => 'Seragam', 'price' => 150000, 'stok' => 25, 'image' => 'seragam2.jpeg'],
            ['name' => 'Seragam Kejuruan Otomotif', 'kategori' => 'Seragam', 'price' => 175000, 'stok' => 25, 'image' => 'seragam3.jpeg'],
            ['name' => 'Seragam Kejuruan Pengelasan', 'kategori' => 'Seragam', 'price' => 175000, 'stok' => 25, 'image' => 'seragam8.jpeg'],
            ['name' => 'Seragam Kejuruan PPLG', 'kategori' => 'Seragam', 'price' => 150000, 'stok' => 25, 'image' => 'seragam5.jpeg'],
            ['name' => 'Seragam Kejuruan TKJ', 'kategori' => 'Seragam', 'price' => 150000, 'stok' => 25, 'image' => 'seragam4.jpeg'],
            ['name' => 'Atribut Sekolah', 'kategori' => 'Atribut (bet sekolah)', 'price' => 25000, 'stok' => 40, 'image' => 'seragam7.jpeg'],
            ['name' => 'Atribut Sekolah', 'kategori' => 'Atribut (topi dan sabuk sekolah)', 'price' => 50000, 'stok' => 30, 'image' => 'seragam6.jpeg'],
        ];

        foreach ($products as $product) {
            Produk::create($product);
        }
    }
}