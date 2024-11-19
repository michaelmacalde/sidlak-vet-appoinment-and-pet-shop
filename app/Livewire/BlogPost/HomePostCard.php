<?php

namespace App\Livewire\BlogPost;

use App\Models\Blog\BlogPost;
use Livewire\Component;

class HomePostCard extends Component
{

    // #[Computed()]
    // public function getIndexBlogPost(){
    //     $this->displayIndexBlogPost = BlogPost::with('author:id,name','categories:id,category_name')
    //             ->where('is_published', true)
    //             ->latest('created_at')
    //             ->take(2)
    //             ->get(['id','author_id', 'post_title', 'post_image', 'post_slug', 'post_content', 'created_at']);

    //     return $this->displayIndexBlogPost;
    // }

    public BlogPost $blogPost;

    public function mount(BlogPost $blogPost)
    {
        $this->blogPost = $blogPost::with('author:id,name', 'categories:id,category_name')
        ->where('is_published', true)
        ->latest('created_at')
        ->take(2)
        ->get(['id','author_id', 'post_title', 'post_image', 'post_slug', 'post_content', 'created_at']);
    }
    public function render()
    {
        return view('livewire.blog-post.home-post-card', ['blogPost' => $this->blogPost]);
    }
}
