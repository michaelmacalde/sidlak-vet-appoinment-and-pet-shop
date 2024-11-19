<?php

namespace Database\Factories\Blog;

use App\Models\User;
use Database\Factories\Concerns\CanCreateBlogPostImage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    use CanCreateBlogPostImage;

    protected static $titleIndex = 0;
    protected static $titles = [
        "10 Tips for Training Your New Puppy",
        "The Ultimate Guide to Dog Nutrition",
        "How to Keep Your Dog Healthy and Happy",
        "Top 5 Dog Breeds for Families",
        "Understanding Your Dog's Body Language",
        "DIY Dog Toys: Fun and Easy Projects",
        "The Benefits of Regular Vet Checkups for Your Dog",
        "How to Socialize Your Dog with Other Pets",
        "Grooming 101: Keeping Your Dog Looking Their Best",
        "The Best Dog Parks in [Your City]",
        "How to Help Your Dog Overcome Separation Anxiety",
        "The Importance of Exercise for Dogs",
        "Homemade Dog Treat Recipes Your Pup Will Love",
        "Adopting a Rescue Dog: What You Need to Know",
        "Traveling with Your Dog: Tips for a Smooth Trip",
        "Senior Dog Care: Keeping Your Old Friend Comfortable",
        "How to Choose the Right Dog Bed",
        "The Top Dog-Friendly Restaurants in [Your City]",
        "Essential Dog Training Commands Every Owner Should Know",
        "Pet Insurance: Is It Worth It for Your Dog?"
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        if (self::$titleIndex >= count(self::$titles)) {
            throw new \Exception("No more unique titles available.");
        }

        $title = self::$titles[self::$titleIndex];
        self::$titleIndex++;

        $paragraphs = [];
        for ($i = 0; $i < 3; $i++) {
            $text = $this->faker->text(1200); // Generate a longer text block
            $words = array_slice(explode(' ', $text), 0, 170); // Get first 170 words
            $paragraphText = implode(' ', $words);

            // Create HTML content with a fixed heading, paragraph, and list

            $paragraphs[] = "<h2>Lorem ipsum dolor sit amet consectetur adipiscing elit tincidunt lobortis</h2>
                        <p>$paragraphText</p>
                        <br>
                        <ul>
                            <li>" . $this->faker->sentence . "</li>
                            <li>" . $this->faker->sentence . "</li>
                            <li>" . $this->faker->sentence . "</li>
                        </ul>
                        <br>";
        }

        $content = implode("\n", $paragraphs); // Combine paragraphs with newlines

        return [
            'post_title' => $title,
            'post_slug' => Str::slug($title),
            'post_image' => $this->createBlogPostImage(),
            'post_content' => $content,
            'is_published' => $this->faker->boolean,
            'author_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
