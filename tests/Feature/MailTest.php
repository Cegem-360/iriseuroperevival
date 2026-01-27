<?php

use App\Mail\MinistryApplicationApproved;
use App\Mail\MinistryApplicationReceived;
use App\Mail\MinistryApplicationRejected;
use App\Mail\OrderConfirmation;
use App\Mail\PaymentConfirmation;
use App\Mail\RefundProcessed;
use App\Mail\RegistrationConfirmation;
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

    $mailable->assertSeeInHtml($registration->first_name);
    $mailable->assertSeeInHtml('Incomplete application');
});

it('renders payment confirmation email', function (): void {
    $registration = Registration::factory()->create([
        'type' => 'attendee',
        'first_name' => 'John',
        'ticket_type' => 'team',
        'amount' => 25000,
        'paid_at' => now(),
    ]);

    $mailable = new PaymentConfirmation($registration);

    $mailable->assertSeeInHtml($registration->first_name);
    $mailable->assertSeeInHtml($registration->uuid);
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

it('queues registration confirmation email', function (): void {
    $mailable = new RegistrationConfirmation(Registration::factory()->create());

    expect($mailable)->toBeInstanceOf(ShouldQueue::class);
});

it('queues order confirmation email', function (): void {
    $mailable = new OrderConfirmation(Order::factory()->create());

    expect($mailable)->toBeInstanceOf(ShouldQueue::class);
});
