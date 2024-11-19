<?php

namespace App\Livewire\Traits;

use App\Models\Animal\Breed;
use Illuminate\Support\Str;

trait WithDogBreeds
{
    public function getDogBreedsPage()
    {
        return Breed::whereHas('dogs', function ($query) {
            $query->where('status', 'available');
        })
        ->take(10)
        ->get(['id', 'breed_name', 'breed_slug', 'breed_image'])
        ->map(function ($breed) {
            $breed->breed_secure_key = $this->generateBreedSecureKey($breed->id);
            return $breed;
        });
    }

    protected function generateBreedSecureKey($breedId)
    {
        $combined = $breedId . Str::random(16);
        return hash('sha256', $combined);
    }
}
