<?php

use Illuminate\Support\Facades\Schema;
use App\Models\Ecommerce\ProductCategory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('prod_name');
            $table->string('prod_slug')->nullable()->unique();
            $table->string('prod_sku')->nullable()->unique();
            $table->decimal('prod_quantity',10,2)->default(1); // quantity in stock dependi pa datatype kng
            $table->decimal('prod_price', 10, 2)->nullable();
            $table->decimal('prod_old_price', 10, 2)->nullable();
            $table->text('prod_short_description')->nullable();
            $table->boolean('prod_requires_shipping')->nullable()->default(false);                // ang shop is naga baligya per kilo na mga dog food
            $table->longText('prod_description')->nullable();
            $table->boolean('is_visible_to_market')->nullable()->default(false);
            $table->string('prod_unit')->default('pcs');
            //$table->decimal('price_per_kg')->nullable();
            $table->decimal('prod_weight')->nullable(); // pila ka kilo ang eh baligya
            // $table->json('prod_image'); // if it is true it will display In Stock else Out of Stock
            // $table->boolean('is_stock')->default(false); 
            //$table->foreignIdFor(ProductCategory::class, 'product_category_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
