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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            // Registration Type & Status
            $table->enum('type', ['attendee', 'ministry', 'volunteer'])->default('attendee');
            $table->enum('status', [
                'pending_payment',
                'pending_approval',
                'approved',
                'rejected',
                'paid',
                'cancelled',
            ])->default('pending_payment');

            // Personal Information
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 255);
            $table->string('phone', 30)->nullable();
            $table->string('country', 100);
            $table->string('city', 100);

            // Ticket Information (for attendees)
            $table->enum('ticket_type', ['individual', 'team'])->nullable();
            $table->unsignedInteger('ticket_quantity')->default(1);
            $table->decimal('amount', 10, 2)->nullable();

            // Ministry Team Fields
            $table->string('citizenship', 100)->nullable();
            $table->json('languages')->nullable();
            $table->string('occupation', 255)->nullable();
            $table->string('church_name', 255)->nullable();
            $table->string('church_city', 100)->nullable();
            $table->string('pastor_name', 200)->nullable();
            $table->string('pastor_email', 255)->nullable();
            $table->boolean('is_born_again')->default(false);
            $table->boolean('is_spirit_filled')->default(false);
            $table->text('testimony')->nullable();
            $table->boolean('attended_ministry_school')->default(false);
            $table->string('ministry_school_name', 255)->nullable();

            // References
            $table->string('reference_1_name', 200)->nullable();
            $table->string('reference_1_email', 255)->nullable();
            $table->string('reference_2_name', 200)->nullable();
            $table->string('reference_2_email', 255)->nullable();

            // Stripe Payment Info
            $table->string('stripe_session_id')->nullable();
            $table->string('stripe_payment_intent')->nullable();
            $table->timestamp('paid_at')->nullable();

            // Approval Workflow
            $table->timestamp('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->unsignedBigInteger('rejected_by')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->text('admin_notes')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('type');
            $table->index('status');
            $table->index('country');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
