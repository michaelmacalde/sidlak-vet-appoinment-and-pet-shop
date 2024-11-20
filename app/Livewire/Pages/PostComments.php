<?php

namespace App\Livewire\Pages;

use App\Models\Blog\BlogPost;
use App\Models\Blog\Comment;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

class PostComments extends Component
{
    public BlogPost $post;

    #[Rule('required|min:3|max:2048')]
    public string $content = '';

    public function mount(BlogPost $post)
    {
        $this->post = $post;
    }

    public function submitComment()
    {
        $this->validate();

        Comment::create([
            'post_id' => $this->post->id,
            'user_id' => auth()->id(),
            'content' => $this->content,
            'is_approved' => false // Optional: you can implement admin approval
        ]);

        $this->reset('content');
        $this->dispatch('comment-added');
    }

    // #[Title('Home')]
    // #[Layout('layouts.app')]
    public function render()
    {
        $comments = $this->post->comments()->latest()->get();

        return view('livewire.pages.post-comments',[
            'comments' => $comments
        ]);
    }
}
