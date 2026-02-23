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
        Schema::table('registrations', function (Blueprint $table): void {
            $table->json('service_areas')->nullable()->after('languages');
            $table->boolean('has_served_before')->default(false)->after('service_areas');
            $table->string('previous_service_description')->nullable()->after('has_served_before');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table): void {
            $table->dropColumn(['service_areas', 'has_served_before', 'previous_service_description']);
        });
    }
};
