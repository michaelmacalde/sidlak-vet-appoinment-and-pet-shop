<?php

namespace App\Livewire\Pages;

use App\Models\Blog\BlogPost;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use Livewire\Component;

class SingleBlogPostPage extends Component
{
    // use WithBlogPostCategory;
    #[Locked]
    public $slug;
    #[Locked]
    public $post;
    #[Locked]
    public $relatedPosts;

    #[Url()]
    public $category = '';
    //initialize variables
    public function mount($slug){
        $this->slug = $slug;
        $this->post = BlogPost::with(['author:id,name', 'categories:id,category_name'])
            ->where('post_slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
        $this->relatedPosts = $this->relatePost();
    }

    // Get related post
    protected function relatePost(){

        $catIds = $this->post->categories->pluck('id');

        return BlogPost::with('categories:id')
                ->where('is_published', true)
                ->where('blog_posts.id', '!=', $this->post->id)
                ->whereHas('categories', function ($query) use ($catIds) {
                    $query->whereIn('blog_posts.id', $catIds);
                })
                ->orderBy('created_at', 'desc')->get(['blog_posts.id', 'post_title','post_image', 'post_slug'])->take(5);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.single-blog-post-page',[
            'post' => $this->post,
            'relatedPosts' => $this->relatedPosts,
            // 'getCategories' => $this->getBlogPostCategory($this->post->id)
        ])->title($this->post->post_title);
    }
}
