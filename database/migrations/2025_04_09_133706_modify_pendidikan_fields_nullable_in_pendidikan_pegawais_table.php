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
        Schema::table('pendidikan_pegawais', function (Blueprint $table) {
            $table->string('pendidikan')->nullable()->change();
            $table->string('nama_sekolah')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendidikan_pegawais', function (Blueprint $table) {
            $table->string('pendidikan')->nullable(false)->change();
            $table->string('nama_sekolah')->nullable(false)->change();
        });
    }
};
