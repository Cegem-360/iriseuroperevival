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
        Schema::create('schedule_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('day');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('type')->default('session'); // session, worship, break, meal, special
            $table->foreignId('speaker_id')->nullable()->constrained()->nullOnDelete();
            $table->string('location')->nullable();
            $table->json('translations')->nullable(); // {en: {title: '...', description: '...'}, hu: {...}}
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_items');
    }
};
