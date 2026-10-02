<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Tambah produk ke keranjang
    public function add(Request $request, $id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = ['qty' => 1];
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    // Tampilkan halaman keranjang
    public function index()
    {
        $cart = Session::get('cart', []);
        $products = ProdukController::daftarProduk();

        $items = [];
        $total = 0;

        foreach ($cart as $id => $data) {
            $product = collect($products)->firstWhere('id', (int) $id);
            if ($product) {
                $subtotal = $product['price'] * $data['qty'];
                $items[] = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'image' => $product['image'],
                    'price' => $product['price'],
                    'qty' => $data['qty'],
                    'subtotal' => $subtotal,
                ];
                $total += $subtotal;
            }
        }

        return view('keranjang', compact('items', 'total'));
    }

    // Update jumlah (qty) produk di keranjang
    public function update(Request $request, $id)
    {
        $cart = Session::get('cart', []);
        $qty = max(1, (int) $request->input('qty', 1));

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = $qty;
            Session::put('cart', $cart);
        }

        return redirect()->back();
    }

    // Hapus produk dari keranjang
    public function remove($id)
    {
        $cart = Session::get('cart', []);
        unset($cart[$id]);
        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }

    // Tampilkan form checkout
    public function checkoutForm()
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('produk')->with('error', 'Keranjang kamu masih kosong.');
        }

        $products = ProdukController::daftarProduk();
        $items = [];
        $total = 0;

        foreach ($cart as $id => $data) {
            $product = collect($products)->firstWhere('id', (int) $id);
            if ($product) {
                $subtotal = $product['price'] * $data['qty'];
                $items[] = [
                    'name' => $product['name'],
                    'qty' => $data['qty'],
                    'subtotal' => $subtotal,
                ];
                $total += $subtotal;
            }
        }

        return view('checkout', compact('items', 'total'));
    }

    // Proses checkout (submit pesanan)
    public function checkoutProcess(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'whatsapp' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        // Hitung ringkasan pesanan sebelum keranjang dikosongkan
        $cart = Session::get('cart', []);
        $products = ProdukController::daftarProduk();
        $totalItem = 0;
        $totalHarga = 0;

        foreach ($cart as $id => $data) {
            $product = collect($products)->firstWhere('id', (int) $id);
            if ($product) {
                $totalItem += $data['qty'];
                $totalHarga += $product['price'] * $data['qty'];
            }
        }

        // Kirim notifikasi ke admin
        \App\Support\Notifier::add(
            'Pesanan Baru',
            $request->nama . ' memesan ' . $totalItem . ' item senilai Rp ' . number_format($totalHarga, 0, ',', '.')
        );

        // Nanti di sini bisa disimpan ke database (Order::create(...))
        // Untuk saat ini, kita kosongkan keranjang dan tampilkan halaman sukses
        Session::forget('cart');

        return view('checkout-sukses', [
            'nama' => $request->nama,
        ]);
    }
}