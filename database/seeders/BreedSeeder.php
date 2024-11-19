<?php

namespace Database\Seeders;

use App\Models\Animal\Breed;
use Database\Factories\Concerns\CanCreateBreedImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BreedSeeder extends Seeder
{
    use CanCreateBreedImage;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dogBreeds = [
            'Aspin',
            'Labrador Retriever',
            'German Shepherd',
            'Golden Retriever',
            'Beagle',
            'Siberian Husky',
        ];

        foreach ($dogBreeds as $breedName) {
            Breed::factory()->create([
                'breed_name' => $breedName,
                'breed_slug' => Str::slug($breedName),
                'breed_image' => $this->createBreedImage($breedName),
            ]);
        }
    }
}
