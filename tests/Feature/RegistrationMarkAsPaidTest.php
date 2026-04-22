<?php

declare(strict_types=1);

use App\Mail\PaymentConfirmation;
use App\Mail\TicketPurchaseConfirmation;
use App\Models\Registration;
use Illuminate\Support\Facades\Mail;

it('queues both payment and ticket-purchase confirmation emails for attendees', function (): void {
    Mail::fake();

    $registration = Registration::factory()->create([
        'type' => 'attendee',
        'status' => 'pending_payment',
        'paid_at' => null,
    ]);

    $registration->markAsPaid('pi_test_123');

    Mail::assertQueued(PaymentConfirmation::class, fn ($mail) => $mail->hasTo($registration->email));
    Mail::assertQueued(TicketPurchaseConfirmation::class, fn ($mail) => $mail->hasTo($registration->email));

    expect($registration->fresh()->status)->toBe('paid')
        ->and($registration->fresh()->stripe_payment_intent)->toBe('pi_test_123');
});

it('does not queue TicketPurchaseConfirmation for non-attendee registrations', function (): void {
    Mail::fake();

    $registration = Registration::factory()->create([
        'type' => 'volunteer',
        'status' => 'pending_approval',
        'paid_at' => null,
    ]);

    $registration->markAsPaid('pi_test_456');

    Mail::assertQueued(PaymentConfirmation::class);
    Mail::assertNotQueued(TicketPurchaseConfirmation::class);
});
