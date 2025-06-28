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
        Schema::table('articles', function (Blueprint $table): void {
            $table->string('approval_status')->after('status')->default(\App\Enums\ArticleApprovalStatus::PENDING->value);
        });

        \App\Models\Article::query()->whereNotNull('published_at')->chunk(200, function ($articles) {
            $ids = $articles->pluck('id');

            \App\Models\Article::whereIn('id', $ids)
                ->update(['approval_status' => \App\Enums\ArticleApprovalStatus::APPROVED]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table): void {
            $table->dropColumn('approval_status');
        });
    }
};
