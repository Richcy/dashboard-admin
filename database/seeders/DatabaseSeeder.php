<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use App\Models\PendidikanPegawai;
use App\Models\JabatanPegawai;
use Illuminate\Support\Facades\DB;
use App\Models\DocumentPegawai;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'test'
        ]);

        DB::transaction(function () {
            Pegawai::factory(250)->create();

            $pegawais = Pegawai::all();

            // foreach ($pegawais as $pegawai) {
            //     DocumentPegawai::factory()->create([
            //         'pegawai_id' => $pegawai->id,
            //         // You can add other fields if needed, e.g. 'jenis_dokumen' => 'foto'
            //     ]);
            // }

            foreach ($pegawais as $pegawai) {
                PendidikanPegawai::factory()
                    ->count(rand(1, 3))
                    ->create([
                        'pegawai_id' => $pegawai->id,
                    ]);
            }

            foreach ($pegawais as $pegawai) {
                // First create the "utama" jabatan (make sure there's only one)
                JabatanPegawai::factory()
                    ->count(1) // Only 1 "utama" jabatan
                    ->create([
                        'pegawai_id' => $pegawai->id,
                        'status_jabatan' => 'utama', // Set status to "utama"
                    ]);

                // Then create additional "tambahan" jabatan (random number between 0 and 2)
                $additionalJabatanCount = rand(0, 2); // You can adjust this if needed

                JabatanPegawai::factory()
                    ->count($additionalJabatanCount) // Random number of "tambahan"
                    ->create([
                        'pegawai_id' => $pegawai->id,
                        'status_jabatan' => 'tambahan', // Set status to "tambahan"
                    ]);
            }
        });
    }
}
