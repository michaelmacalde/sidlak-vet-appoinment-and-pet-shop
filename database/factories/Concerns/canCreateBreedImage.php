<?php

namespace Database\Factories\Concerns;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Database\Seeders\LocalImages;

trait CanCreateBreedImage
{
    public function createBreedImage(string $breedName): ?string
    {
        $breedImages = [
            'Aspin' => 'aspin.jpg',
            'Labrador Retriever' => 'labrador_retriever.jpg',
            'German Shepherd' => 'german_shepherd.jpg',
            'Golden Retriever' => 'golden_retriever.jpg',
            'Beagle' => 'beagle.jpg',
            'Siberian Husky' => 'siberian_husky.jpg',
        ];

        $filename = $breedImages[$breedName] ?? null;

        if (!$filename) {
            // If the breed image is not found, return null or handle it accordingly
            return null;
        }

        // Get the path to the image file
        $filePath = database_path('seeders/local_images/breeds/' . $filename);

        // Use file_get_contents to read the image file
        $image = file_get_contents($filePath);

        $newFilename = Str::slug($breedName) . '_' . Str::uuid() . '.jpg';

        // Store the image in the storage disk
        Storage::disk('public')->put($newFilename, $image);

        return $newFilename;
    }
}
