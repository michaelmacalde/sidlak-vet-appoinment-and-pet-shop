<?php

namespace Database\Seeders;

use App\Models\Animal\Dog;
use App\Models\Animal\MedicalRecord;
use Illuminate\Database\Seeder;

class MedicalRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dogs = Dog::all(); // Get all dogs
        $totalRecords = $dogs->count() * 2; // Calculate total medical records
        $progressBar = $this->command->getOutput()->createProgressBar($totalRecords);
        $progressBar->setFormat("CREATING MEDICAL RECORDS\n %current%/%max% [%bar%] %percent:3s%%");

        $progressBar->start();

        foreach ($dogs as $dog) {
            for ($i = 0; $i < 2; $i++) {
                MedicalRecord::factory()->create([
                    'dog_id' => $dog->id, // Associate with the current dog
                ]);
                $progressBar->advance();
            }
        }

        $progressBar->finish();
        $this->command->line(''); // Move to the next line after progress bar finishes
    }
}
