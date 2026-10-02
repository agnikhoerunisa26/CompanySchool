<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Support\ActivityLogger;
use Illuminate\Http\Request;

class ProdukAdminController extends Controller
{
    public function index(Request $request)
    {
        $products = Produk::orderBy('id')->get();

        $totalProduk = $products->count();
        $totalKategori = $products->pluck('kategori')->unique()->count();

        $perPage = 6;
        $currentPage = (int) $request->query('page', 1);
        $totalPages = max(1, (int) ceil($products->count() / $perPage));
        $paged = $products->forPage($currentPage, $perPage)->values();

        return view('admin.produk.index', [
            'products' => $paged,
            'totalProduk' => $totalProduk,
            'totalKategori' => $totalKategori,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'startNumber' => ($currentPage - 1) * $perPage,
            'totalData' => $products->count(),
        ]);
    }

    public function create()
    {
        return view('admin.produk.form', [
            'product' => null,
            'formAction' => route('admin.produk.store'),
            'formTitle' => 'Tambah Produk Baru',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string|max:1500',
            'foto' => 'required|image|max:5120',
        ]);

        $file = $request->file('foto');
        $imageName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $imageName);

        // "Simpan Draft" selalu draft, "Simpan Produk" mengikuti toggle publikasi
        $status = $request->input('action') === 'draft'
            ? 'draft'
            : ($request->boolean('is_published') ? 'publish' : 'draft');

        $produk = Produk::create([
            'name' => $data['name'],
            'kategori' => $data['kategori'],
            'price' => (int) $data['price'],
            'stok' => (int) $data['stok'],
            'deskripsi' => $data['deskripsi'] ?? '',
            'image' => $imageName,
            'status' => $status,
        ]);

        $pesan = $status === 'draft' ? 'Produk disimpan sebagai draft.' : 'Produk baru berhasil ditambahkan.';
        ActivityLogger::log('created', 'Produk Baru Ditambahkan', '"' . $produk->name . '"');

        if ($produk->stok === 0) {
            ActivityLogger::log('outofstock', 'Produk Habis Stok', 'Stok "' . $produk->name . '" telah habis.', 'komentar-hapus');
        }

        return redirect()->route('admin.produk.index')->with('success', $pesan);
    }

    public function edit($id)
    {
        $product = Produk::findOrFail($id);

        return view('admin.produk.form', [
            'product' => $product,
            'formAction' => route('admin.produk.update', $product->id),
            'formTitle' => 'Edit Produk',
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string|max:1500',
            'foto' => 'nullable|image|max:5120',
        ]);

        $product = Produk::findOrFail($id);

        $status = $request->input('action') === 'draft'
            ? 'draft'
            : ($request->boolean('is_published') ? 'publish' : 'draft');

        $updateData = [
            'name' => $data['name'],
            'kategori' => $data['kategori'],
            'price' => (int) $data['price'],
            'stok' => (int) $data['stok'],
            'deskripsi' => $data['deskripsi'] ?? '',
            'status' => $status,
        ];

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $imageName);
            $updateData['image'] = $imageName;
        }

        $product->update($updateData);

        $pesan = $status === 'draft' ? 'Produk disimpan sebagai draft.' : 'Produk berhasil diperbarui.';
        ActivityLogger::log('updated', 'Produk Diperbarui', '"' . $product->name . '"');

        if ($product->stok === 0) {
            ActivityLogger::log('outofstock', 'Produk Habis Stok', 'Stok "' . $product->name . '" telah habis.', 'komentar-hapus');
        }

        return redirect()->route('admin.produk.index')->with('success', $pesan);
    }

    public function destroy($id)
    {
        $product = Produk::findOrFail($id);
        $name = $product->name;
        $product->delete();

        ActivityLogger::log('deleted', 'Produk Dihapus', '"' . $name . '"');

        return redirect()->route('admin.produk.index')->with('success', 'Berhasil menghapus produk.');
    }
}