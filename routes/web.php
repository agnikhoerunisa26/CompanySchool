<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ArtikelAdminController;
use App\Http\Controllers\Admin\ProdukAdminController;
use App\Http\Controllers\Admin\EkstrakurikulerAdminController;
use App\Http\Controllers\Admin\GaleriAdminController;
use App\Http\Controllers\Admin\KontakAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel');
Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])->name('ekstrakurikuler');
Route::get('/produk', [ProdukController::class, 'index'])->name('produk');

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'send'])->name('kontak.send');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/lupa-kata-sandi', [AuthController::class, 'showForgotPassword'])->name('forgot-password');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/aktivitas', [DashboardController::class, 'aktivitas'])->name('admin.aktivitas.index');

    Route::post('/admin/notifikasi/baca', function () {
        \App\Support\Notifier::markAllRead();
        return back();
    })->name('admin.notifikasi.baca');

    Route::get('/admin/artikel', [ArtikelAdminController::class, 'index'])->name('admin.artikel.index');
    Route::get('/admin/artikel/tambah', [ArtikelAdminController::class, 'create'])->name('admin.artikel.create');
    Route::post('/admin/artikel', [ArtikelAdminController::class, 'store'])->name('admin.artikel.store');
    Route::get('/admin/artikel/{id}/edit', [ArtikelAdminController::class, 'edit'])->name('admin.artikel.edit');
    Route::put('/admin/artikel/{id}', [ArtikelAdminController::class, 'update'])->name('admin.artikel.update');
    Route::delete('/admin/artikel/{id}', [ArtikelAdminController::class, 'destroy'])->name('admin.artikel.destroy');

    Route::get('/admin/produk', [ProdukAdminController::class, 'index'])->name('admin.produk.index');
    Route::get('/admin/produk/tambah', [ProdukAdminController::class, 'create'])->name('admin.produk.create');
    Route::post('/admin/produk', [ProdukAdminController::class, 'store'])->name('admin.produk.store');
    Route::get('/admin/produk/{id}/edit', [ProdukAdminController::class, 'edit'])->name('admin.produk.edit');
    Route::put('/admin/produk/{id}', [ProdukAdminController::class, 'update'])->name('admin.produk.update');
    Route::delete('/admin/produk/{id}', [ProdukAdminController::class, 'destroy'])->name('admin.produk.destroy');

    Route::get('/admin/ekstrakurikuler', [EkstrakurikulerAdminController::class, 'index'])->name('admin.ekstrakurikuler.index');
    Route::get('/admin/ekstrakurikuler/tambah', [EkstrakurikulerAdminController::class, 'create'])->name('admin.ekstrakurikuler.create');
    Route::post('/admin/ekstrakurikuler', [EkstrakurikulerAdminController::class, 'store'])->name('admin.ekstrakurikuler.store');
    Route::get('/admin/ekstrakurikuler/{id}/edit', [EkstrakurikulerAdminController::class, 'edit'])->name('admin.ekstrakurikuler.edit');
    Route::put('/admin/ekstrakurikuler/{id}', [EkstrakurikulerAdminController::class, 'update'])->name('admin.ekstrakurikuler.update');
    Route::delete('/admin/ekstrakurikuler/{id}', [EkstrakurikulerAdminController::class, 'destroy'])->name('admin.ekstrakurikuler.destroy');

    Route::get('/admin/galeri', [GaleriAdminController::class, 'index'])->name('admin.galeri.index');
    Route::get('/admin/galeri/tambah', [GaleriAdminController::class, 'create'])->name('admin.galeri.create');
    Route::post('/admin/galeri', [GaleriAdminController::class, 'store'])->name('admin.galeri.store');
    Route::get('/admin/galeri/{id}/edit', [GaleriAdminController::class, 'edit'])->name('admin.galeri.edit');
    Route::put('/admin/galeri/{id}', [GaleriAdminController::class, 'update'])->name('admin.galeri.update');
    Route::delete('/admin/galeri/{id}', [GaleriAdminController::class, 'destroy'])->name('admin.galeri.destroy');

    Route::get('/admin/kontak', [KontakAdminController::class, 'index'])->name('admin.kontak.index');
    Route::get('/admin/kontak/{id}', [KontakAdminController::class, 'show'])->name('admin.kontak.show');
    Route::post('/admin/kontak/{id}/draft', [KontakAdminController::class, 'saveDraft'])->name('admin.kontak.draft');
    Route::post('/admin/kontak/{id}/balas', [KontakAdminController::class, 'reply'])->name('admin.kontak.balas');
    Route::delete('/admin/kontak/{id}', [KontakAdminController::class, 'destroy'])->name('admin.kontak.destroy');
    Route::post('/admin/kontak/{id}/balas', [KontakAdminController::class, 'balas'])->name('admin.kontak.balas');
    Route::get('/admin/kontak/balasan/{id}/unduh', [KontakAdminController::class, 'unduh'])->name('admin.kontak.unduh');
    Route::get('/admin/kontak/{id}/unduh-lampiran', [KontakAdminController::class, 'unduhLampiran'])->name('admin.kontak.unduh-lampiran');
});