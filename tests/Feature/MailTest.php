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
use App\Mail\VolunteerApplicationApproved;
use App\Mail\VolunteerApplicationReceived;
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

it('uses a hungarian subject for the ministry rejected email when the applicant locale is hungarian', function (): void {
    $registration = Registration::factory()->create([
        'type' => 'ministry',
        'locale' => 'hu',
        'status' => 'rejected',
        'rejection_reason' => 'Indok',
    ]);

    app()->setLocale('en');

    $mailable = new MinistryApplicationRejected($registration);

    $mailable->assertHasSubject('Szolgálócsapat jelentkezés frissítés - Europe Revival 2026');
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

it('captures the applicant locale when a registration is created', function (): void {
    app()->setLocale('hu');

    $registration = Registration::factory()->create(['type' => 'volunteer']);

    expect($registration->locale)->toBe('hu');
});

it('renders volunteer received email in english', function (): void {
    $registration = Registration::factory()->create([
        'type' => 'volunteer',
        'first_name' => 'Hegedus',
        'locale' => 'en',
    ]);

    $mailable = new VolunteerApplicationReceived($registration);

    $mailable->assertSeeInHtml('Dear Hegedus,');
    $mailable->assertSeeInHtml('Thank you for your willingness to serve with us as a volunteer');
    $mailable->assertSeeInHtml('We have received your application');
});

it('renders volunteer received email in the applicant hungarian locale even when app locale is english', function (): void {
    $registration = Registration::factory()->create([
        'type' => 'volunteer',
        'first_name' => 'Hegedus',
        'locale' => 'hu',
    ]);

    app()->setLocale('en');

    $mailable = new VolunteerApplicationReceived($registration);

    $mailable->assertSeeInHtml('Köszönjük, hogy szeretnél velünk szolgálni önkéntesként');
    $mailable->assertSeeInHtml('Megkaptuk a jelentkezésedet');
    $mailable->assertDontSeeInHtml('Thank you for your willingness');
});

it('renders volunteer approved email in the applicant hungarian locale regardless of admin locale', function (): void {
    $registration = Registration::factory()->create([
        'type' => 'volunteer',
        'first_name' => 'Hegedus',
        'locale' => 'hu',
    ]);

    app()->setLocale('en');

    $mailable = new VolunteerApplicationApproved($registration);

    $mailable->assertSeeInHtml('Örömmel értesítünk, hogy önkéntes jelentkezésedet elfogadtuk!');
    $mailable->assertSeeInHtml('Iris Europe Revival 2026 csapata');
    $mailable->assertDontSeeInHtml('We are pleased to inform you');
});

it('uses a hungarian subject for the volunteer rejected email when the applicant locale is hungarian', function (): void {
    $registration = Registration::factory()->create([
        'type' => 'volunteer',
        'locale' => 'hu',
        'status' => 'rejected',
        'rejection_reason' => 'Indok',
    ]);

    app()->setLocale('en');

    $mailable = new VolunteerApplicationRejected($registration);

    $mailable->assertHasSubject('Önkéntes jelentkezés frissítése - Europe Revival 2026');
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

it('renders reference request email in the applicant locale', function (): void {
    $registration = Registration::factory()->ministry()->create([
        'locale' => 'hu',
        'reference_1_name' => 'Pastor Smith',
        'reference_1_email' => 'pastor@example.com',
    ]);

    $mailable = new ReferenceRequest($registration, 1, 'Pastor Smith');

    $mailable->assertSeeInHtml('Ajánlás kérés');
    $mailable->assertSeeInHtml('Megerősítés');
    $mailable->assertDontSeeInHtml('Reference Request');
});

it('pins the applicant locale so queued mail keeps it on the worker', function (): void {
    $registration = Registration::factory()->ministry()->create([
        'locale' => 'hu',
        'reference_1_name' => 'Pastor Smith',
        'reference_1_email' => 'pastor@example.com',
    ]);

    $mailable = new ReferenceRequest($registration, 1, 'Pastor Smith');

    app()->setLocale('en');

    $mailable->assertSeeInHtml('Ajánlás kérés');
    $mailable->assertDontSeeInHtml('Reference Request');
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
