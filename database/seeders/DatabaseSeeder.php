<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clear images
        Storage::deleteDirectory('public');

        $this->call([
            UserSeeder::class,
            BreedSeeder::class,
            DogSeeder::class,
            MedicalRecordSeeder::class,
            BlogPostSeeder::class,
            CategorySeeder::class,
            BlogPostCategorySeeder::class,
            CommentSeeder::class,
            // VolunteerSeeder::class
        ]);
    }
}
