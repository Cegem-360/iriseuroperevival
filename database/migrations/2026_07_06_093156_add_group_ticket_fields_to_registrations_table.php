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
            $table->boolean('is_group_ticket')->default(false)->after('ticket_quantity');
            $table->string('ticket_day')->nullable()->after('is_group_ticket');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table): void {
            $table->dropColumn(['is_group_ticket', 'ticket_day']);
        });
    }
};
