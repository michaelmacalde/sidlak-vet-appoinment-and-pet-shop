<?php

namespace App\Models\Adoption;

use App\Models\Animal\Dog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdoptionCart extends Model
{
    use HasFactory;

    protected $table = 'adoption_carts';
    protected $fillable = ['user_id', 'dog_id'];

    public function dog() : BelongsTo
    {
        return $this->belongsTo(Dog::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeGetCartInfo($query, $userId, $dogId)
    {
        return $query->where('user_id', $userId)
            ->selectRaw('COUNT(*) as total_count')
            ->addSelect(['dog_exists' => static::where('user_id', $userId)
                ->where('dog_id', $dogId)
                ->selectRaw('COUNT(*)')
            ]);
    }

}
