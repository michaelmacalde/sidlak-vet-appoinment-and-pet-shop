<?php

namespace App\Models\Application;

use App\Models\Adoption\Adoption;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ApplicationForm extends Model
{
    use HasFactory;

    protected $table = 'application_forms';

    protected $fillable = [
        'user_id',
        // 'dog_id',
        'type_of_home',
        'is_own_home',
        'owners_name',
        'temporary_address',
        'permanent_address',
        'contact_details',
        'has_any_pet',
        'preferred_date',
        'preferred_time',
        'can_visit_shelter'
    ];

    protected $casts = [
        'can_visit_shelter' => 'boolean',
        'has_any_pet' => 'boolean',
        'is_own_home' => 'boolean',
        'contact_details' => 'array',
    ];

    public function petDetails() : HasMany
    {
        return $this->hasMany(PetDetails::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function dog() : BelongsTo
    // {
    //     return $this->belongsTo(Dog::class);
    // }

    public function adoptions() : HasMany
    {
        return $this->hasMany(Adoption::class);
    }
}
