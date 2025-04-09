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
        Schema::create('jabatan_pegawais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained()->onDelete('cascade');
            $table->string('bidang');
            $table->string('ruangan');
            $table->string('jabatan');
            $table->string('jenjang_jabatan');
            $table->string('golongan_pangkat');
            $table->date('tmt_jabatan');
            $table->enum('status_jabatan', ['utama', 'tambahan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan_pegawais');
    }
};
