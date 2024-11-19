<?php

namespace Database\Seeders;

use App\Models\Blog\BlogPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\Concerns\CanCreateBlogPostImage;

class BlogPostSeeder extends Seeder
{
    use CanCreateBlogPostImage;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $totalPosts = 20;
        $progressBar = $this->command->getOutput()->createProgressBar($totalPosts);
        $progressBar->setFormat("CREATING BLOG POSTS\n %current%/%max% [%bar%] %percent:3s%%");

        $progressBar->start();

        self::setUnusedFeaturedImages(LocalImages::getFeaturedImage());

        for ($i = 0; $i < $totalPosts; $i++) {
            BlogPost::factory()->create();
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->command->line('');
    }
}
