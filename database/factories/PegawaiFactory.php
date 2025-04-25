<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_dengan_gelar' => $this->faker->name,
            'nama_tanpa_gelar' => $this->faker->name,
            'jenis_kelamin' => $this->faker->randomElement(['Laki-Laki', 'Perempuan']),
            'nip_npp' => $this->faker->unique()->numerify('#############'),
            'tmt_kerja' => $this->faker->date(),
            'nik' => $this->faker->unique()->numerify('#############'),
            'tanggal_lahir' => $this->faker->date(),
            'tempat_lahir' => $this->faker->city,
            'status_asn' => $this->faker->randomElement(['PNS', 'PPPK', 'Kontrak BLUD']),
            'tmt_asn' => $this->faker->date(),
            'status_perkawinan' => $this->faker->randomElement(['Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati']),
            'tanggungan' => $this->faker->numberBetween(0, 5),
            'alamat' => $this->faker->address,
            'rt' => $this->faker->numberBetween(1, 10),
            'rw' => $this->faker->numberBetween(1, 10),
            'kelurahan_desa' => $this->faker->citySuffix,
            'kecamatan' => $this->faker->city,
            'kota_kabupaten' => $this->faker->city,
            'provinsi' => $this->faker->state,
            'bank' => $this->faker->randomElement(['BRI', 'BNI', 'BCA', 'Mandiri']),
            'nomor_rekening' => $this->faker->numerify('#############'),
            'npwp' => $this->faker->numerify('###############'),
            'nomor_telepon' => $this->faker->unique()->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'status_pegawai' => $this->faker->randomElement(['aktif', 'nonaktif']),
        ];
    }
}
