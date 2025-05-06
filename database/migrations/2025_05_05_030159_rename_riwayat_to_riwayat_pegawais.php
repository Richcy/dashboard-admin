<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('riwayat_pegawai', 'riwayat_pegawais');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('riwayat_pegawais', 'riwayat_pegawai');
    }
};
