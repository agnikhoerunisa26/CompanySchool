<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanKontak extends Model
{
    protected $fillable = [
        'nama', 'email', 'subjek', 'pesan', 'sudah_dibaca',
        'ip_address', 'balasan_draft', 'balasan', 'dibalas_pada',
    ];

    protected $casts = [
        'dibalas_pada' => 'datetime',
    ];

    public function getTanggalAttribute()
    {
        return $this->created_at->translatedFormat('d F Y, H:i');
    }

    public function getKodeAttribute()
    {
        return 'MSG-' . $this->created_at->format('Y') . '-' . str_pad($this->id, 4, '0', STR_PAD_LEFT);
    }

    public function getInisialAttribute()
    {
        return strtoupper(collect(explode(' ', trim($this->nama)))
            ->map(fn($w) => mb_substr($w, 0, 1))
            ->take(2)
            ->implode(''));
    }
}