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
        'user_id',
        'volunteer_role',
        'volunteer_reason',
        'volunteer_status',
        'volunteer_status_type',
        'volunteer_joined_date'
    ];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
