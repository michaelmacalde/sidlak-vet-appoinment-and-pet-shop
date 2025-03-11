<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Testing\Fluent\Concerns\Has;

class ProductCategory extends Model
{

    use HasFactory;
    
    protected $table = 'product_categories';

    protected $fillable = [
        'prod_cat_name',
        'prod_cat_slug',
        'prod_cat_description',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,
        'product_prod_categories','product_category_id','product_id')->withTimestamps();
    }


}
