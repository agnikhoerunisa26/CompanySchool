<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $products = Produk::orderBy('id')->get();

        return view('produk', compact('products'));
    }
}