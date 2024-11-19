<?php

use App\Models\Animal\Dog;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('adoption_carts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Dog::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoption_carts');
    }
};
