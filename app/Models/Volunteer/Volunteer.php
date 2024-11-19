<?php

namespace App\Models\Volunteer;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Volunteer extends Model
{
    use HasFactory;

    protected $table = 'volunteers';
    protected $fillable = [
        'user_id', 'role', 'reason', 'status', 'status_type', 'joined_date'
    ];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
