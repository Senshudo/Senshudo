<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * // TODO: Types? 3 = Review | 0 = Article
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('author_id')->constrained('authors');
            $table->foreignId('category_id')->nullable()->constrained('categories');
            $table->foreignId('event_id')->nullable()->constrained('events');
            $table->string('title');
            $table->string('slug');
            $table->tinyText('excerpt');
            $table->longText('content');
            $table->mediumText('keywords')->nullable();
            $table->json('sources')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
