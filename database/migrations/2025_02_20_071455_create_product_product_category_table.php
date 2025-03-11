<?php

use App\Models\Blog\Category;
use App\Models\Ecommerce\Product;
use App\Models\Ecommerce\ProductCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_prod_categories', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(Product::class, 'product_id')->constrained()->cascadeOnDelete();
            // $table->foreignIdFor(ProductCategory::class, 'product_category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_category_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_prod_cat');
    }
};
