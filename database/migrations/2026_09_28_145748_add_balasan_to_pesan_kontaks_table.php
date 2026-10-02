<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesan_kontaks', function (Blueprint $table) {
            $table->string('ip_address', 45)->nullable();
            $table->text('balasan_draft')->nullable();
            $table->text('balasan')->nullable();
            $table->timestamp('dibalas_pada')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pesan_kontaks', function (Blueprint $table) {
            $table->dropColumn(['ip_address', 'balasan_draft', 'balasan', 'dibalas_pada']);
        });
    }
};