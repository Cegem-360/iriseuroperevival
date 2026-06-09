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
            $table->timestamp('reference_1_responded_at')->nullable()->after('reference_1_response');
            $table->timestamp('reference_2_responded_at')->nullable()->after('reference_2_response');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table): void {
            $table->dropColumn(['reference_1_responded_at', 'reference_2_responded_at']);
        });
    }
};
