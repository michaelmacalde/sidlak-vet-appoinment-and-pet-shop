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
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->enum('volunteer_role', ['dog_walking', 'event_assistance', 'admin_support', 'community_outreach']);
            $table->text('volunteer_reason')->nullable();
            $table->enum('volunteer_status', ['active', 'inactive'])->default('active');
            $table->enum('volunteer_status_type', ['pending', 'approved', 'rejected'])->default('pending');
            $table->date('volunteer_joined_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};
