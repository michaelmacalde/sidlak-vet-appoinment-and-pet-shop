<?php

namespace Database\Seeders;

use App\Models\Blog\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $totalCategories = 20; // Define the total number of categories to create
        $progressBar = $this->command->getOutput()->createProgressBar($totalCategories);
        $progressBar->setFormat("CREATING CATEGORIES\n %current%/%max% [%bar%] %percent:3s%%");

        $progressBar->start();

        Category::factory($totalCategories)->create();

        $progressBar->finish();
        $this->command->line(''); // Move to the next line after progress bar finishes
    }
}
