<?php

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
        Schema::create('application_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            // $table->foreignIdFor(Dog::class)->constrained()->cascadeOnDelete();
            $table->enum('type_of_home', ['home','apartment','villa','other']);
            $table->boolean('is_own_home')->default(true);
            $table->string('owners_name')->nullable();
            $table->string('temporary_address')->nullable();
            $table->string('permanent_address');
            $table->json('contact_details');
            $table->boolean('has_any_pet')->default(false);
            $table->date('preferred_date');
            $table->time('preferred_time');
            $table->boolean('can_visit_shelter')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_forms');
    }
};
