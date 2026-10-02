<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesan_balasans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pesan_kontak_id')->index();
            $table->text('isi');
            $table->string('lampiran_path')->nullable();
            $table->string('lampiran_nama')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesan_balasans');
    }
};