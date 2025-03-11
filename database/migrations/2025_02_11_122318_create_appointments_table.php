<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Appointment\AppointmentCategory;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(AppointmentCategory::class, 'appoint_cat_id')->constrained()->cascadeOnDelete();
            $table->string('pet_name');
            $table->enum('pet_type', ['dog', 'cat'])->default('dog');
            $table->string('pet_breed');
            $table->enum('pet_gender', ['male', 'female'])->default('male');
            $table->string('pet_age');
            $table->string('pet_weight');
            $table->boolean('isPetVaccinated')->default(false)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
