<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use Illuminate\Support\Str;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        Pegawai::create([
            'nama_dengan_gelar' => 'Dr. John Doe, S.T., M.T.',
            'nama_tanpa_gelar' => 'John Doe',
            'nip_npp' => '198304102010011019',
            'tmt_kerja' => now()->subYears(10), // 10 years ago
            'nik' => '3201234567890001',
            'status_asn' => 'ASN',
            'tmt_asn' => now()->subYears(8), // 8 years ago
            'status_perkawinan' => 'Kawin',
            'tanggungan' => '2',
            'alamat' => 'Jl. Merdeka No. 10, Jakarta',
            'rt' => '01',
            'rw' => '02',
            'kelurahan_desa' => 'Kelurahan ABC',
            'kecamatan' => 'Kecamatan XYZ',
            'kota_kabupaten' => 'Jakarta Pusat',
            'provinsi' => 'DKI Jakarta',
            'bank' => 'Bank BNI',
            'nomor_rekening' => '1234567890',
            'npwp' => '12.345.678',
            'nomor_telepon' => '081234567890',
            'email' => 'johndoe@example.com',
        ]);
    }
}
