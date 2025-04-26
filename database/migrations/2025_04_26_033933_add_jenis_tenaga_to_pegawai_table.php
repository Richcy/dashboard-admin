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
            $table->enum('jenis_tenaga', ['nakes', 'non_nakes', 'struktural'])
                ->after('tmt_kerja') // adjust position as needed
                ->nullable(); // or remove nullable if it's required
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->dropColumn('jenis_tenaga');
        });
    }
};
