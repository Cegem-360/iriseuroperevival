<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('speakers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('organization')->nullable();
            $table->string('country')->nullable();
            $table->text('bio')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('type')->default('speaker'); // speaker, worship_leader, host
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->json('social_links')->nullable(); // twitter, facebook, instagram, website
            $table->json('translations')->nullable(); // {en: {bio: '...'}, hu: {bio: '...'}}
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speakers');
    }
};
