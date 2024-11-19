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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('donation_number')->unique()->index();
            $table->string('donor_payment_intent_id')->nullable();
            $table->string('donor_name');
            $table->string('donor_email');
            $table->string('donor_phone_number');
            $table->string('donor_address')->nullable();
            $table->decimal('donor_amount', 8, 2)->nullable();
            $table->string('donor_payment_method')->nullable();
            $table->string('donor_status')->nullable();
            $table->text('donor_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
