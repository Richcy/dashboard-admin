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
        Schema::table('jabatan_pegawais', function (Blueprint $table) {
            $table->string('bidang')->nullable()->change();
            $table->string('ruangan')->nullable()->change();
            $table->string('jabatan')->nullable()->change();
            $table->string('jenjang_jabatan')->nullable()->change();
            $table->string('golongan_pangkat')->nullable()->change();
            $table->date('tmt_jabatan')->nullable()->change();
            $table->enum('status_jabatan', ['utama', 'tambahan'])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jabatan_pegawais', function (Blueprint $table) {
            $table->string('bidang')->nullable(false)->change();
            $table->string('ruangan')->nullable(false)->change();
            $table->string('jabatan')->nullable(false)->change();
            $table->string('jenjang_jabatan')->nullable(false)->change();
            $table->string('golongan_pangkat')->nullable(false)->change();
            $table->date('tmt_jabatan')->nullable(false)->change();
            $table->enum('status_jabatan', ['utama', 'tambahan'])->nullable(false)->change();
        });
    }
};
