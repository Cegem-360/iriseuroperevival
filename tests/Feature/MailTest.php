<?php

declare(strict_types=1);

use App\Mail\MinistryApplicationApproved;
use App\Mail\MinistryApplicationReceived;
use App\Mail\MinistryApplicationRejected;
use App\Mail\OrderConfirmation;
use App\Mail\PaymentConfirmation;
use App\Mail\ReferenceRequest;
use App\Mail\RefundProcessed;
use App\Mail\RegistrationConfirmation;
use App\Mail\TicketPurchaseConfirmation;
use App\Mail\VolunteerApplicationRejected;
use App\Models\Order;
use App\Models\Registration;
use Illuminate\Contracts\Queue\ShouldQueue;

it('renders registration confirmation email', function (): void {
    $registration = Registration::factory()->create([
        'type' => 'attendee',
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@example.com',
        'ticket_type' => 'individual',
        'amount' => 10000,
    ]);

    $mailable = new RegistrationConfirmation($registration);

    $mailable->assertSeeInHtml($registration->first_name);
    $mailable->assertSeeInHtml($registration->uuid);
    $mailable->assertSeeInHtml($registration->email);
});

it('renders ministry application received email', function (): void {
    $registration = Registration::factory()->create([
        'type' => 'ministry',
        'first_name' => 'Jane',
        'church_name' => 'Test Church',
    ]);

    $mailable = new MinistryApplicationReceived($registration);

    $mailable->assertSeeInHtml($registration->first_name);
    $mailable->assertSeeInHtml($registration->uuid);
    $mailable->assertSeeInHtml('Test Church');
});

it('renders ministry application approved email', function (): void {
    $registration = Registration::factory()->create([
        'type' => 'ministry',
        'first_name' => 'Jane',
        'status' => 'approved',
    ]);

    $mailable = new MinistryApplicationApproved($registration);

    $mailable->assertSeeInHtml($registration->first_name);
    $mailable->assertSeeInHtml('Approved');
});

it('renders ministry application rejected email with reason', function (): void {
    $registration = Registration::factory()->create([
        'type' => 'ministry',
        'first_name' => 'Jane',
        'status' => 'rejected',
        'rejection_reason' => 'Incomplete application',
    ]);

    $mailable = new MinistryApplicationRejected($registration);

    $mailable->assertSeeInHtml('Incomplete application');
});

it('renders ministry rejected email with the bilingual default letter when no reason is set', function (): void {
    $registration = Registration::factory()->create([
        'type' => 'ministry',
        'first_name' => 'Jane',
        'status' => 'rejected',
        'rejection_reason' => null,
    ]);

    $mailable = new MinistryApplicationRejected($registration);

    $mailable->assertSeeInHtml('Kedves Jane!');
    $mailable->assertSeeInHtml('Köszönjük, hogy jelentkeztél');
    $mailable->assertSeeInHtml('Dear Jane,');
    $mailable->assertSeeInHtml('Europe Revival Organizers');
});

it('renders volunteer rejected email with the bilingual default letter when no reason is set', function (): void {
    $registration = Registration::factory()->create([
        'type' => 'volunteer',
        'first_name' => 'Mark',
        'status' => 'rejected',
        'rejection_reason' => null,
    ]);

    $mailable = new VolunteerApplicationRejected($registration);

    $mailable->assertSeeInHtml('Kedves Mark!');
    $mailable->assertSeeInHtml('Dear Mark,');
    $mailable->assertSeeInHtml('Áldással és szeretettel');
});

it('renders volunteer rejected email with the admin-edited reason when set', function (): void {
    $registration = Registration::factory()->create([
        'type' => 'volunteer',
        'first_name' => 'Mark',
        'status' => 'rejected',
        'rejection_reason' => 'Custom edited message from admin',
    ]);

    $mailable = new VolunteerApplicationRejected($registration);

    $mailable->assertSeeInHtml('Custom edited message from admin');
});

it('renders payment confirmation email with human-readable ticket type', function (): void {
    $registration = Registration::factory()->create([
        'type' => 'attendee',
        'first_name' => 'John',
        'ticket_type' => '1_day',
        'amount' => 25000,
        'paid_at' => now(),
    ]);

    $mailable = new PaymentConfirmation($registration);

    $mailable->assertSeeInHtml($registration->first_name);
    $mailable->assertSeeInHtml($registration->uuid);
    $mailable->assertSeeInHtml('1 Day Supporter Pass');
    $mailable->assertDontSeeInHtml('1_day');
});

it('renders ticket purchase confirmation email with human-readable ticket type', function (): void {
    $registration = Registration::factory()->create([
        'type' => 'attendee',
        'first_name' => 'Anna',
        'ticket_type' => '3_days',
        'amount' => 17500,
        'paid_at' => now(),
    ]);

    $mailable = new TicketPurchaseConfirmation($registration);

    $mailable->assertSeeInHtml($registration->first_name);
    $mailable->assertSeeInHtml($registration->uuid);
    $mailable->assertSeeInHtml('3 Day Supporter Pass');
    $mailable->assertDontSeeInHtml('3_days');
    $mailable->assertHasSubject(__('Thank you for your ticket purchase — Europe Revival 2026'));
});

it('queues ticket purchase confirmation email', function (): void {
    $mailable = new TicketPurchaseConfirmation(Registration::factory()->create());

    expect($mailable)->toBeInstanceOf(ShouldQueue::class);
});

it('renders refund processed email', function (): void {
    $registration = Registration::factory()->create([
        'first_name' => 'John',
        'amount' => 25000,
    ]);

    $mailable = new RefundProcessed($registration, 15000);

    $mailable->assertSeeInHtml($registration->first_name);
    $mailable->assertSeeInHtml($registration->uuid);
});

it('renders order confirmation email', function (): void {
    $order = Order::factory()->create([
        'customer_name' => 'Test Customer',
        'total' => 5000,
    ]);

    $mailable = new OrderConfirmation($order);

    $mailable->assertSeeInHtml('Test Customer');
    $mailable->assertSeeInHtml($order->uuid);
});

it('renders reference request email', function (): void {
    $registration = Registration::factory()->create([
        'type' => 'ministry',
        'first_name' => 'Jane',
        'last_name' => 'Doe',
        'reference_1_name' => 'Pastor Smith',
        'reference_1_email' => 'pastor@example.com',
    ]);

    $mailable = new ReferenceRequest($registration, 1, 'Pastor Smith');

    $mailable->assertSeeInHtml('Pastor Smith');
    $mailable->assertSeeInHtml($registration->full_name);
});

it('queues reference request email', function (): void {
    $registration = Registration::factory()->create(['type' => 'ministry']);

    $mailable = new ReferenceRequest($registration, 1, 'Pastor Smith');

    expect($mailable)->toBeInstanceOf(ShouldQueue::class);
});

it('renders reference request email with a signed confirmation url', function (): void {
    $registration = Registration::factory()->ministry()->create([
        'reference_1_name' => 'Pastor Smith',
        'reference_1_email' => 'pastor@example.com',
    ]);

    $mailable = new ReferenceRequest($registration, 1, 'Pastor Smith');

    $mailable->assertSeeInHtml('signature=', false);
    $mailable->assertSeeInHtml($registration->uuid);
});

it('queues registration confirmation email', function (): void {
    $mailable = new RegistrationConfirmation(Registration::factory()->create());

    expect($mailable)->toBeInstanceOf(ShouldQueue::class);
});

it('queues order confirmation email', function (): void {
    $mailable = new OrderConfirmation(Order::factory()->create());

    expect($mailable)->toBeInstanceOf(ShouldQueue::class);
});
