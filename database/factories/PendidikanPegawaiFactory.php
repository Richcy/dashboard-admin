<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pegawai;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PendidikanPegawai>
 */
class PendidikanPegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pegawai_id' => Pegawai::factory(), // or use existing ID later in seeder
            'pendidikan' => $this->faker->randomElement(['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3']),
            'nama_sekolah' => $this->faker->company . ' University',
            'jurusan' => $this->faker->word(),
            'nomor_ijazah' => strtoupper($this->faker->bothify('IJZ-####-????')),
            'tahun_lulus' => $this->faker->year(),
        ];
    }
}
