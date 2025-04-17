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
        Schema::table('pegawais', function (Blueprint $table) {
            //
            DB::statement("ALTER TABLE pegawais MODIFY status_asn ENUM('PNS', 'PPPK', 'Kontrak BLUD') NOT NULL DEFAULT 'Kontrak BLUD'");
            DB::statement("ALTER TABLE pegawais MODIFY status_perkawinan ENUM('Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati') NOT NULL DEFAULT 'Belum Kawin'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            //
            DB::statement("ALTER TABLE pegawais MODIFY status_asn ENUM('PNS', 'PPPK', 'Kontrak BLUD') NULL DEFAULT 'Kontrak BLUD'");
            DB::statement("ALTER TABLE pegawais MODIFY status_perkawinan ENUM('Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati') NULL DEFAULT 'Belum Kawin'");
        });
    }
};
