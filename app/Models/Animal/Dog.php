<?php

namespace App\Models\Animal;

use App\Models\Adoption\Adoption;
use App\Models\Adoption\AdoptionCart;
use App\Models\Application\ApplicationForm;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Dog extends Model
{
    use HasFactory;

    protected $table = 'dogs';
    protected $fillable = [
        'dog_name',
        'dog_age',
        'breed_id',
        'dog_size',
        'dog_gender',
        'dog_short_description',
        'dog_long_description',
        'dog_image',
        'status',
    ];

    protected $casts = [
        'dog_image' => 'array',
    ];

    public function getFirstDogImageAttribute()
    {
        $images = $this->dog_image;
        return $images[0] ?? null;
    }



    public function breed() : BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }

    public function adoption() : HasOne
    {
        return $this->hasOne(Adoption::class);
    }

    public function medicalRecords() : HasMany
    {
        return $this->hasMany(MedicalRecord::class, 'dog_id', 'id');
    }

    public function applicatinForm() : HasOne
    {
        return $this->hasOne(ApplicationForm::class);
    }

    public function adoptionCarts() : HasMany
    {
        return $this->hasMany(AdoptionCart::class, 'dog_id', 'id');
    }

    public function scopeWithBreed($query, string $breed){
        $query->whereHas('breed', function($query) use($breed) {
            $query->where('breed_slug', $breed);
        });
    }

    public function scopeWithLimitedDescriptionAndSecureKey(Builder $query)
    {
        return $query->addSelect(['*'])
            ->withCasts(['dog_short_description' => 'string'])
            ->when(true, function ($query) {
                $query->getModel()->append(['secure_key', 'limited_description']);
            });
    }

    public function getLimitedDescriptionAttribute()
    {
        return Str::limit(strip_tags($this->dog_short_description), 70);
    }

    public function getSecureKeyAttribute()
    {
        $combined = $this->id . Str::random(16);
        return hash('sha256', $combined);
    }
}
