<?php

namespace App\Models;

use App\Models\Blog\BlogPost;
use App\Models\Blog\Category;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Livewire\Livewire;

class Announcement extends Model
{
    protected $table = 'announcements';

    protected $fillable = [
        'user_id',
        'blog_post_id',
        'category_id',
        'announcement_title',
        'announcement_content',
        'announcement_img',
        'is_announced',
        'announcement_date',
    ];

    protected $casts = [
        'is_announced' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'announcement_date',
    ];



    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function blogPost() : BelongsTo
    {
        return $this->belongsTo(BlogPost::class, 'blog_post_id', 'id');
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    protected static function booted()
    {
        // static::created(function ($announcement) {


        //     dispatch('announcementAdded');

        //     Notification::make()
        //         ->title('New Announcement')
        //         ->body("{$announcement->announcement_title} has been added!")
        //         ->success()
        //         ->send();
        // });
    }
}
