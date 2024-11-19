<?php

namespace Database\Seeders;

use App\Models\Blog\BlogPost;
use App\Models\Blog\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogPosts = BlogPost::all(); // Get all blog posts
        $totalComments = $blogPosts->count() * 5; // Calculate total comments (5 comments per post)
        $progressBar = $this->command->getOutput()->createProgressBar($totalComments);
        $progressBar->setFormat("CREATING COMMENTS\n %current%/%max% [%bar%] %percent:3s%%");

        $progressBar->start();

        foreach ($blogPosts as $blogPost) {
            Comment::factory(5)->create(['post_id' => $blogPost->id]);
            $progressBar->advance(5); // Increment by 5 for each blog post
        }

        $progressBar->finish();
        $this->command->line(''); // Move to the next line after progress bar finishes
    }
}
