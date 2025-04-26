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
            $table->enum('posisi_jabatan', ['struktural', 'jabfung', 'pelaksana', 'honorer'])
                ->nullable()
                ->after('jenis_tenaga'); // or wherever you want to place it
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->dropColumn('posisi_jabatan');
        });
    }
};
