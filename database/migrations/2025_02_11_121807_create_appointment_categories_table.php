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
        Schema::create('appointment_categories', function (Blueprint $table) {
            $table->id();
            $table->string('appoint_cat_name')->unique();
            $table->string('appoint_cat_slug')->unique();
            $table->text('appoint_cat_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_categories');
    }
};
