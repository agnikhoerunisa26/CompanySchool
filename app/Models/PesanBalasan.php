<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanBalasan extends Model
{
    protected $fillable = [
        'pesan_kontak_id', 'isi', 'lampiran_path', 'lampiran_nama',
    ];

    public function getTanggalAttribute()
    {
        return $this->created_at->translatedFormat('d F Y, H:i');
    }
}