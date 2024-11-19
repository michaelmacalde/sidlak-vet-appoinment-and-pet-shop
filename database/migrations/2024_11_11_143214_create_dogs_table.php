<?php

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
        Schema::create('dogs', function (Blueprint $table) {
            $table->id();
            $table->string('dog_name')->unique();
            $table->string('dog_slug')->unique();
            $table->string('dog_age');
            $table->foreignId('breed_id')->nullable()->constrained('breeds')->cascadeOnDelete();
            $table->string('dog_size');
            $table->enum('dog_gender', ['male', 'female']);
            $table->text('dog_short_description');
            $table->text('dog_long_description')->nullable();
            $table->json('dog_image')->nullable();
            $table->enum('status', ['available', 'adopted', 'fostered'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dogs');
    }
};
