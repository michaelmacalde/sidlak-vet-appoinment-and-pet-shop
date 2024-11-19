<?php

namespace Database\Factories\Blog;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryName = $this->faker->unique()->word;

        return [
            'category_name' => $categoryName,
            'category_slug' => Str::slug($categoryName),
            'category_description' => $this->faker->sentence,
        ];
    }
}
