<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Adoption\Adoption;
use App\Models\Blog\BlogPost;
use App\Models\Blog\Comment;
use App\Models\Donation\Donation;
use App\Models\Volunteer\Volunteer;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use HasPanelShield;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function volunteer() : HasOne
    {
        return $this->hasOne(Volunteer::class);
    }

    public function blogPosts() : HasMany
    {
        return $this->hasMany(BlogPost::class);
    }

    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function adoption() : HasMany
    {
        return $this->hasMany(Adoption::class);
    }

    public function donations() : HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function blogPostLikes() : BelongsToMany
    {
        return $this->belongsToMany(BlogPost::class, 'blog_post_like')->withTimestamps();
    }


    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasAnyRole(['super_admin', 'volunteer', 'admin']);
    }


    // public function applicationForm() : HasOne
    // {
    //     return $this->hasOne(ApplicationForm::class);
    // }

    // public function adoptionCarts() : HasMany
    // {
    //     return $this->hasMany(AdoptionCart::class);
    // }
}
