<?php

namespace App\Models\Ecommerce;

use App\Models\OrderItem;
use App\Models\Ecommerce\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'prod_name',
        'prod_slug',
        'prod_price',
        'prod_description',
        'prod_quantity',
        'prod_sku',
        'prod_unit',
        'prod_requires_shipping',
        'prod_weight', // pila ka kilo ang eh baligya
        'prod_short_description',
        'prod_old_price',
        'is_visible_to_market',
    ];

    
    /**
     * @var array<string, string>
     */
    protected $casts = [
        'prod_requires_shipping' => 'boolean',
        'is_visible_to_market' => 'boolean',
    ];

    public function productCategories(): BelongsToMany
    {
        return $this->belongsToMany(ProductCategory::class,
        'product_prod_categories','product_id','product_category_id')->withTimestamps();
    }


    // public function category(): BelongsTo
    // {
    //     return $this->belongsTo(ProductCategory::class, 'product_category_id');
    // }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
