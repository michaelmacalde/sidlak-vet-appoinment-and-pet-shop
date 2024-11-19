<?php

namespace App\Livewire\Pages;

use App\Models\Animal\Dog;
use App\Models\Blog\BlogPost;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Str;

class HomePage extends Component
{
    public $displayIndexDogs;

    #[Locked]
    public $displayIndexBlogPost;

    #[Computed]
    public function getIndexDog()
    {
        $this->displayIndexDogs = Dog::where('status', 'available')
            ->latest('created_at')
            ->take(4)
            ->get(['id', 'dog_image', 'dog_name', 'dog_slug']);
        return $this->displayIndexDogs;
    }

    #[Computed]
    public function getIndexBlogPost()
    {
        $this->displayIndexBlogPost = BlogPost::with('author:id,name', 'categories:id,category_name')
            ->where('is_published', true)
            ->latest('created_at')
            ->take(2)
            ->get(['id', 'author_id', 'post_title', 'post_image', 'post_slug', 'post_content', 'created_at'])
            ->map(function ($post) {
                $post->post_content_excerpt = Str::limit(strip_tags($post->post_content), 70);
                return $post;
            });

        return $this->displayIndexBlogPost;
    }

    #[Title('Home')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.home-page', [
            'displayIndexDogs' => $this->getIndexDog(),
            'displayIndexPosts' => $this->getIndexBlogPost(),
        ]);
    }
}
