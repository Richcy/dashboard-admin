<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Pegawai;
use PHPUnit\Framework\Attributes\Test;

class PegawaiTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function bisa_menambahkan_info_pegawai()
    {
        // Login sebagai user
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'nama_dengan_gelar' => 'Minty Lucu, S.Kom',
            'nama_tanpa_gelar' => 'Minty Lucu',
            'jenis_kelamin' => 'Laki-Laki',
            'nip_npp' => '1234567890',
            'tmt_kerja' => '2020-01-01',
            'jenis_tenaga' => 'nakes',
            'nik' => '3201234567890001',
            'tanggal_lahir' => '1997-01-01',
            'tempat_lahir' => 'Cimacan',
            'status_asn' => 'Kontrak BLUD',
            'tmt_asn' => '2020-01-01',
            'status_perkawinan' => 'Belum Kawin',
            'tanggungan' => "0",
            'alamat' => 'Jalan Lucu No. 1',
            'rt' => '001',
            'rw' => '002',
            'kelurahan_desa' => 'Lucukarya',
            'kecamatan' => 'Kecamatan Lucu',
            'kota_kabupaten' => 'Kota Lucu',
            'provinsi' => 'Jawa Barat',
            'bank' => 'BRI',
            'nomor_rekening' => '123456789',
            'npwp' => '123456789012345',
            'nomor_telepon' => '081234567890',
            'email' => 'minty@example.com',
            'status_pegawai' => 'aktif',
        ];

        $response = $this->post('/pegawai', $data);

        $response->assertStatus(302); // redirect setelah simpan
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('pegawais', [
            'nama_tanpa_gelar' => 'Minty Lucu',
            'nip_npp' => '1234567890',
        ]);
    }
}
