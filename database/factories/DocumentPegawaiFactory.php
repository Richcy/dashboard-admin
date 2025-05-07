<?php

namespace Database\Factories;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocumentPegawai>
 */
class DocumentPegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate random image name
        $imageName = $this->faker->image('public/storage/pegawai_foto', 400, 400, null, false);

        // Generate the path for the image
        $imagePath = 'pegawai_foto/' . $imageName;

        // Optionally, you can make sure the image is generated and saved
        if (!Storage::disk('public')->exists($imagePath)) {
            // If the image doesn't exist, you can download a placeholder or any image from the web
            $imageContent = file_get_contents('https://via.placeholder.com/400');
            Storage::disk('public')->put($imagePath, $imageContent);
        }

        return [
            'pegawai_id' => Pegawai::factory(), // Associates the document with a created Pegawai
            'jenis_dokumen' => 'foto', // Specify this document as 'foto'
            'nama_file' => $imageName, // Name of the image file
            'path' => $imagePath, // Path to the stored image
        ];
    }
}
