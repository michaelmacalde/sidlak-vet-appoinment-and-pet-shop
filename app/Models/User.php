<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Panel;
use App\Models\Blog\Comment;
use App\Models\Blog\BlogPost;
use App\Models\Ecommerce\Cart;
use App\Models\Ecommerce\Order;
use App\Models\Adoption\Adoption;
use App\Models\Donation\Donation;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Volunteer\Volunteer;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Appointment\Appointment;
use App\Models\Ecommerce\ProductReview;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    //use HasPanelShield;

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
        $user = Auth::user(); // or use auth()->user()

        if (!$user) {
            return false; // Prevents errors when no user is logged in
        }

        return $user->hasAnyRole(['super_admin','admin','admin_shop']);
    }



    public function announcements() : HasMany
    {
        return $this->hasMany(Announcement::class);
    }


    // public function applicationForm() : HasOne
    // {
    //     return $this->hasOne(ApplicationForm::class);
    // }

    // public function adoptionCarts() : HasMany
    // {
    //     return $this->hasMany(AdoptionCart::class);
    // }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
