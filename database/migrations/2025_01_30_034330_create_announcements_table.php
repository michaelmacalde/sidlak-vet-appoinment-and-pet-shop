<?php

use App\Models\Blog\BlogPost;
use App\Models\Blog\Category;
use App\Models\User;
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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignIdFor(BlogPost::class, 'blog_post_id')->nullable()->constrained('blog_posts')->cascadeOnDelete();
            $table->foreignIdFor(Category::class, 'category_id')->nullable()->constrained('categories')->cascadeOnDelete();
            $table->string('announcement_title');
            $table->text('announcement_content');
            $table->string('announcement_img')->nullable();
            $table->boolean('is_announced')->default(0);
            $table->dateTime('announcement_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
