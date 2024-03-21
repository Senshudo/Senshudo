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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained('articles');
            $table->string('oneliner')->nullable();
            $table->text('quote')->nullable();
            $table->decimal('overall', 8, 2)->nullable();
            $table->decimal('graphics', 8, 2)->nullable();
            $table->decimal('story', 8, 2)->nullable();
            $table->decimal('gameplay', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
