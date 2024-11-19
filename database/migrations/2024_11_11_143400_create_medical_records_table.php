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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dog_id')->constrained()->onDelete('cascade');
            $table->string('record_type'); // Type of medical record (e.g., vaccination, check-up)
            $table->text('description'); // Description of the medical record
            $table->date('record_date'); // Date of the medical record
            $table->string('vet_name')->nullable(); // Name of the veterinarian
            $table->string('vet_contact')->nullable(); // Contact information for the veterinarian
            $table->decimal('cost', 8, 2)->nullable(); // Cost of the medical treatment
            $table->string('next_appointment')->nullable(); // Next appointment date or details
            $table->text('medications')->nullable(); // Medications prescribed
            $table->text('notes')->nullable(); // Additional notes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
