<?php

namespace Database\Factories\Animal;

use App\Models\Animal\Breed;
use App\Models\Animal\Dog;
use Database\Factories\Concerns\CanCreateDogImage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dog>
 */
class DogFactory extends Factory
{
    use CanCreateDogImage;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genders = ['male', 'female'];
        $sizes = ['small', 'medium', 'large'];
        $namePrefixes = ['Buddy', 'Charlie', 'Max', 'Bailey', 'Cooper', 'Daisy', 'Lucy', 'Sadie', 'Molly', 'Tucker', 'Rocky', 'Luna', 'Stella', 'Bella', 'Sophie', 'Blacky', 'whitey'];

        $dogName = $this->getUniqueDogName($namePrefixes);
        $dogSlug = Str::slug($dogName);

        return [
            'dog_name' => $dogName,
            'dog_slug' => $dogSlug,
            'dog_age' => $this->faker->numberBetween(1, 5), // Assuming the age is between 1 and 15
            'breed_id' => Breed::inRandomOrder()->first()->id,
            'dog_size' => $this->faker->randomElement($sizes),
            'dog_gender' => $this->faker->randomElement($genders),
            'dog_short_description' => $this->faker->paragraph,
            'dog_long_description' => $this->faker->paragraph,
            'dog_image' => [['dog_image' => $this->createDogImage()]],
            'status' => 'available', // Set the status to always be 'available'
        ];
    }

    /**
     * Get a unique dog name from the list of name prefixes.
     *
     * @param array $namePrefixes
     * @return string
     */
    protected function getUniqueDogName(array $namePrefixes): string
    {
        $uniqueNameFound = false;
        $dogName = '';

        while (!$uniqueNameFound) {
            $name = $this->faker->randomElement($namePrefixes);
            if (!Dog::where('dog_name', $name)->exists()) {
                $dogName = $name;
                $uniqueNameFound = true;
            }
        }

        return $dogName;
    }
}
