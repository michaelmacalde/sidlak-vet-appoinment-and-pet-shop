<?php

use App\Models\Application\ApplicationForm;
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
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();
            $table->string('adoption_number')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('dog_id')->nullable()->constrained('dogs')->cascadeOnDelete();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->date('request_date')->nullable();
            $table->foreignIdFor(ApplicationForm::class)->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoptions');
    }
};
