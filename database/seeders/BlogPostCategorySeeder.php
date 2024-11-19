<?php

namespace Database\Seeders;

use App\Models\Blog\BlogPost;
use App\Models\Blog\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogPostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogPosts = BlogPost::all(); // Get all blog posts
        $totalRecords = $blogPosts->count() * 5; // Calculate total records (5 categories per blog post)
        $progressBar = $this->command->getOutput()->createProgressBar($totalRecords);
        $progressBar->setFormat("CREATING BLOG POST CATEGORIES\n %current%/%max% [%bar%] %percent:3s%%");

        $progressBar->start();

        foreach ($blogPosts as $blogPost) {
            $categories = Category::inRandomOrder()->limit(5)->pluck('id')->toArray(); // Get 5 random category IDs
            foreach ($categories as $categoryId) {
                $blogPost->categories()->attach($categoryId);
                $progressBar->advance();
            }
        }

        $progressBar->finish();
        $this->command->line(''); // Move to the next line after progress bar finishes
    }
}
