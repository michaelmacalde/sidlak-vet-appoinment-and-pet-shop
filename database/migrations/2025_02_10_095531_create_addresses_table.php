<?php

use Illuminate\Support\Facades\DB;
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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('country')->nullable()->default('Philippines');
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->enum('address_type', ['billing', 'shipping'])->nullable(); // Add Address Type
            if (DB::getDriverName() === 'pgsql') {
                $table->string('full_address')->storedAs("street || ', ' || zip || ' ' || city")->nullable();
            } elseif (DB::getDriverName() === 'sqlite') {
                $table->string('full_address')->virtualAs("street || ', ' || zip || ' ' || city")->nullable();
            } else {
                $table->string('full_address')->virtualAs("CONCAT(street, ', ', zip, ' ', city)")->nullable();
            }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
