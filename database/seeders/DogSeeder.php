<?php

namespace Database\Seeders;

use App\Models\Animal\Dog;
use Illuminate\Database\Seeder;
use Database\Factories\Concerns\CanCreateDogImage;

class DogSeeder extends Seeder
{
    use CanCreateDogImage;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $totalDogs = 17; // Define the total number of dogs to create
        $progressBar = $this->command->getOutput()->createProgressBar($totalDogs);
        $progressBar->setFormat("CREATING DOGS\n %current%/%max% [%bar%] %percent:3s%%");

        // Reset the unused images list
        self::setUnusedImages(LocalImages::getAllFiles());

        $progressBar->start();

        for ($i = 0; $i < $totalDogs; $i++) {
            Dog::factory()->create();
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->command->line('');
    }
}
