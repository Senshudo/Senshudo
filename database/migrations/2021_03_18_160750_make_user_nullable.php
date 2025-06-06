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
        Schema::table('versions', function (Blueprint $table): void {
            $table->unsignedBigInteger(config('versionable.user_foreign_key', 'user_id'))->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('versions', function (Blueprint $table): void {
            $table->unsignedBigInteger(config('versionable.user_foreign_key', 'user_id'))->nullable(false)->change();
        });
    }
};
