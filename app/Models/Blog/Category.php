<?php

namespace App\Models\Blog;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;


    /**
     * Indicates if attributes should be escaped when casting to a string.
     *
     * @var bool
     */
    protected $escapeWhenCastingToString = true;

    protected $table = 'categories';
    protected $fillable = [
        'category_name', 'category_slug', 'category_description',
    ];

    public function blogPosts() : BelongsToMany
    {
        return $this->belongsToMany(BlogPost::class, 'blog_post_category')->withTimestamps();
    }


    public function announcements() : HasMany
    {
        return $this->hasMany(Announcement::class);
    }

}
