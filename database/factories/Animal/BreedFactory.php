<?php

namespace Database\Factories\Animal;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal\Breed>
 */
class BreedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'breed_description' => $this->faker->paragraph,
        ];
    }
}
