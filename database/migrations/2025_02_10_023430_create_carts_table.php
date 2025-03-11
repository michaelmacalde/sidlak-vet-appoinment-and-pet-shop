<?php

use App\Models\User;
use App\Models\Ecommerce\Product;
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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class, 'product_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class, 'user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->decimal('quantity');
            $table->string('session_id')->nullable(); 
            $table->timestamps();
        });

        // gamiton si session_id for guest user nga naga add to cart
        //if si user mg decide to create an account tanan nga gin png add to cart
        // from session_id ma merge sa iya account
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
