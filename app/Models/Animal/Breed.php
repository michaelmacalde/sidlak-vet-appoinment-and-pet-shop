<?php

namespace App\Models\Animal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Breed extends Model
{
    use HasFactory;

    protected $table = 'breeds';
    protected $fillable = [
        'breed_name', 'breed_slug', 'breed_image', 'breed_description'
    ];


    public function dogs() : HasMany
    {
        return $this->hasMany(Dog::class);
    }
}
