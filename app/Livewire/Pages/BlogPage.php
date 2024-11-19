<?php

namespace App\Livewire\Pages;

use App\Models\Blog\BlogPost;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class BlogPage extends Component
{
    use WithPagination;
    #[Locked]
    #[Computed]
    public function getBlogPostPage()
    {
        return BlogPost::query()
        ->select(['id', 'author_id', 'post_title', 'post_slug', 'post_image', 'post_content', 'created_at'])
        ->with([
            'author:id,name',
            'categories:id,category_name',
        ])
        ->where('is_published', true)
        ->orderBy('created_at', 'desc')
        ->paginate(6)
        ->through(function ($post) {
            $post->post_content = Str::limit(strip_tags($post->post_content), 70);
            return $post;
        });
    }

    #[Title('Blog Post Page')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.blog-page',[
            'blogPostsPage' => $this->getBlogPostPage()
        ]);
    }
}
