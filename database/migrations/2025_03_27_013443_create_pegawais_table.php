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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dengan_gelar', 100);
            $table->string('nama_tanpa_gelar', 75);
            $table->string('nip_npp', 18)->unique();
            $table->date('tmt_kerja');
            $table->string('nik', 16)->unique()->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->enum('status_asn', ['ASN', 'Non-ASN'])->nullable();
            $table->date('tmt_asn')->nullable();
            $table->enum('status_perkawinan', ['Belum Kawin', 'Kawin', 'Cerai'])->nullable();
            $table->integer('tanggungan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('rt', 3)->nullable();
            $table->string('rw', 3)->nullable();
            $table->string('kelurahan_desa', 75)->nullable();
            $table->string('kecamatan', 50)->nullable();
            $table->string('kota_kabupaten', 75)->nullable();
            $table->string('provinsi', 50)->nullable();
            $table->string('bank', 50)->nullable();
            $table->string('nomor_rekening', 25)->nullable();
            $table->string('npwp', 15)->nullable();
            $table->string('nomor_telepon', 20)->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
