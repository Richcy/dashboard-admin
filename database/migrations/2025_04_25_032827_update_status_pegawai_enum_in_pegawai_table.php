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
        DB::table('pegawais')
            ->where('status_pegawai', 'resign')
            ->update(['status_pegawai' => 'nonaktif']);

        // Step 2: Change enum AFTER the data is updated
        DB::statement("ALTER TABLE pegawais MODIFY status_pegawai ENUM('aktif', 'nonaktif')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse order when rolling back
        DB::table('pegawais')
            ->where('status_pegawai', 'nonaktif')
            ->update(['status_pegawai' => 'resign']);

        DB::statement("ALTER TABLE pegawais MODIFY status_pegawai ENUM('aktif', 'resign')");
    }
};
