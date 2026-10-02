<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesan_kontaks', function (Blueprint $table) {
            $table->string('lampiran_balasan')->nullable();
            $table->string('lampiran_balasan_nama')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pesan_kontaks', function (Blueprint $table) {
            $table->dropColumn(['lampiran_balasan', 'lampiran_balasan_nama']);
        });
    }
};