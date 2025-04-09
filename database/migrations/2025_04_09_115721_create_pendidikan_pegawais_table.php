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
        Schema::create('pendidikan_pegawais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained()->onDelete('cascade');
            $table->string('pendidikan');
            $table->string('nama_sekolah');
            $table->string('jurusan')->nullable();
            $table->string('nomor_ijazah')->nullable();
            $table->year('tahun_lulus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikan_pegawais');
    }
};
