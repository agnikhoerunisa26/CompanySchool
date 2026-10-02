<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'articles';

    protected $fillable = [
        'title', 'badge', 'image', 'excerpt', 'content', 'published_date', 'status',
    ];

    protected $casts = [
        'published_date' => 'date',
    ];

    // Supaya $article['date'] otomatis tampil terformat, tanpa ubah blade
    public function getDateAttribute()
    {
        return $this->published_date ? $this->published_date->translatedFormat('d F Y') : '';
    }

    // Dipakai untuk isi ulang input tanggal di form edit
    public function getDateRawAttribute()
    {
        return $this->published_date ? $this->published_date->format('Y-m-d') : '';
    }
}