<?php

namespace Database\Factories\Blog;

use App\Models\Blog\BlogPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id' => BlogPost::inRandomOrder()->first()->id,
            'user_id' => User::factory(),
            'content' => $this->faker->paragraph,
            'is_approved' => $this->faker->boolean,
        ];
    }
}
