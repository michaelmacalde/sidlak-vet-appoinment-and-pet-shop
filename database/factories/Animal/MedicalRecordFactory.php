<?php

namespace Database\Factories\Animal;

use App\Models\Animal\Dog;
use App\Models\Animal\MedicalRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal\MedicalRecord>
 */
class MedicalRecordFactory extends Factory
{
    protected $model = MedicalRecord::class;

    /**
     * Veterinarian names.
     *
     * @var array
     */
    protected $veterinarians = [
        'Dr. Samantha Smith',
        'Dr. Michael Johnson',
        'Dr. Emily Brown',
        'Dr. Daniel Martinez',
        'Dr. Sarah Davis',
        'Dr. Christopher Wilson',
        'Dr. Jennifer Taylor',
        'Dr. David Anderson',
        'Dr. Jessica Garcia',
        'Dr. Matthew Thomas',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nextAppointment = $this->faker->optional()->dateTimeBetween('+1 week', '+1 year');

        return [
            'dog_id' => Dog::inRandomOrder()->first()->id,
            'record_type' => $this->faker->word, // Changed 'type' to 'record_type'
            'description' => $this->faker->paragraph,
            'record_date' => $this->faker->date(),
            'vet_name' => $this->faker->randomElement($this->veterinarians),
            'vet_contact' => $this->faker->phoneNumber,
            'cost' => $this->faker->randomFloat(2, 50, 500),
            'next_appointment' => $nextAppointment ? $nextAppointment->format('Y-m-d') : null,
            'medications' => $this->faker->optional()->words(3, true),
            'notes' => $this->faker->optional()->paragraph,
        ];
    }
}
