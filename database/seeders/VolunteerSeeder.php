<?php

namespace Database\Seeders;

use App\Models\Volunteer;
use App\Models\Volunteer\Volunteer\Volunteer as VolunteerVolunteer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VolunteerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $totalVolunteers = 15;
        $progressBar = $this->command->getOutput()->createProgressBar($totalVolunteers);
        $progressBar->setFormat("CREATING VOLUNTEERS\n %current%/%max% [%bar%] %percent:3s%%");

        $progressBar->start();

        for ($i = 0; $i < $totalVolunteers; $i++) {
            VolunteerVolunteer::factory()->create(); // Use the correct class reference here
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->command->info("\n Volunteers created successfully!");
    }
}
