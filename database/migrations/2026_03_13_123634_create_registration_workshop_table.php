<?php

declare(strict_types=1);

use App\Models\Registration;
use App\Models\Workshop;
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
        Schema::create('registration_workshop', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Registration::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Workshop::class)->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['registration_id', 'workshop_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_workshop');
    }
};
