<?php

namespace App\Http\Controllers;

use App\Models\PesanKontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

       PesanKontak::create($data + ['ip_address' => $request->ip()]);

        // Kirim notifikasi ke admin
        \App\Support\Notifier::add(
            'Pesan Kontak Baru',
            $data['nama'] . ' mengirim pesan: "' . $data['subjek'] . '"'
        );

        return redirect()->route('kontak')->with('success', 'Pesan kamu berhasil dikirim. Kami akan segera menghubungi kembali.');
    }
}