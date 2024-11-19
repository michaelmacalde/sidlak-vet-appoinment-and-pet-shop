<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Volunteer>
 */
class VolunteerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'role' => $this->faker->randomElement(['dog_walking', 'event_assistance', 'admin_support', 'community_outreach']),
            'reason' => $this->faker->optional()->sentence(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'status_type' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'joined_date' => $this->faker->optional()->date(),
        ];
    }
}
