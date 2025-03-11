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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->constrained('users')->cascadeOnDelete();
           // $table->foreignIdFor(Product::class, 'product_id')->constrained('products')->cascadeOnDelete();
            $table->decimal('total',10,2)->nullable();
            $table->text('notes')->nullable();
            $table->enum('order_status',['new','processing','shipped','delivered','cancelled'])->default('new');
            //notes dependi pa if my cancelation of order same mn sa refunded.
            $table->enum('payment_status', ['pending', 'completed', 'failed','refunded'])->default('pending')->nullable();
            $table->foreignId('shipping_address_id')->nullable()->constrained('addresses')->onDelete('set null');
            $table->foreignId('billing_address_id')->nullable()->constrained('addresses')->onDelete('set null');
            $table->boolean('is_billing_same_as_shipping')->default(false);
            $table->decimal('shipping_price')->nullable();
            $table->string('shipping_method')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
