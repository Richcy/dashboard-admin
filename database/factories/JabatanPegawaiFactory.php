<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pegawai;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JabatanPegawai>
 */
class JabatanPegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pegawai_id' => Pegawai::factory(), // or override in seeder
            'bidang' => $this->faker->jobTitle(),
            'ruangan' => 'Ruangan ' . $this->faker->numberBetween(1, 10),
            'jabatan' => $this->faker->randomElement(['Kepala Seksi', 'Staf', 'Kepala Bidang']),
            'jenjang_jabatan' => $this->faker->randomElement(['Ahli Pertama', 'Ahli Muda', 'Ahli Madya']),
            'golongan_pangkat' => $this->faker->randomElement(['III/a', 'III/b', 'III/c', 'IV/a']),
            'tmt_jabatan' => $this->faker->date(),
            'status_jabatan' => $this->faker->randomElement(['utama', 'tambahan']),
        ];
    }
}
