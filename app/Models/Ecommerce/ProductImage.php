<?php

namespace App\Models\Ecommerce;

use App\Models\Ecommerce\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    //protected $table = 'product_images';
    protected $fillable = [
        'product_id',
        // 'product_img',
        'url',
        'alt_text',
        'is_primary',
        'display_order',
    ];
     /**
     * @var array<string, string>
     */
    protected $casts = [
        'display_order' => 'integer',
        'is_primary' => 'boolean'
    ];


    



    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
