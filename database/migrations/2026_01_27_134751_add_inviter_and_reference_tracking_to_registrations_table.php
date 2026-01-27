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
        Schema::table('registrations', function (Blueprint $table) {
            // Inviter person (optional field for ministry team)
            $table->string('invited_by', 200)->nullable()->after('reference_2_email');

            // Reference tracking
            $table->timestamp('reference_1_contacted_at')->nullable()->after('invited_by');
            $table->enum('reference_1_status', ['pending', 'contacted', 'responded', 'approved', 'rejected'])->nullable()->after('reference_1_contacted_at');
            $table->text('reference_1_response')->nullable()->after('reference_1_status');

            $table->timestamp('reference_2_contacted_at')->nullable()->after('reference_1_response');
            $table->enum('reference_2_status', ['pending', 'contacted', 'responded', 'approved', 'rejected'])->nullable()->after('reference_2_contacted_at');
            $table->text('reference_2_response')->nullable()->after('reference_2_status');

            // Confirmation email sent
            $table->timestamp('confirmation_email_sent_at')->nullable()->after('reference_2_response');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn([
                'invited_by',
                'reference_1_contacted_at',
                'reference_1_status',
                'reference_1_response',
                'reference_2_contacted_at',
                'reference_2_status',
                'reference_2_response',
                'confirmation_email_sent_at',
            ]);
        });
    }
};
