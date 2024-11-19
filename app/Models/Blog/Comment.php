<?php

namespace App\Models\Blog;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = [
        'post_id', 'user_id', 'content', 'is_approved'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function blogPost() : BelongsTo
    {
        return $this->belongsTo(BlogPost::class, 'post_id');
    }
}
