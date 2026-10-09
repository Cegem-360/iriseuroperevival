<?php

declare(strict_types=1);

use App\Models\Registration;
use Illuminate\Support\Carbon;
use Tests\TestCase;

it('admits one person per ticket for orders placed before the 2-for-1 offer', function (): void {
    $registration = Registration::factory()->attendee()->create([
        'ticket_type' => '3_days',
        'ticket_quantity' => 3,
        'is_group_ticket' => true,
        'created_at' => Carbon::parse(Registration::TWO_FOR_ONE_SINCE)->subMinute(),
    ]);

    expect($registration->admitted_people)->toBe(3);
});

it('admits two people per ticket since the 2-for-1 offer', function (): void {
    $individual = Registration::factory()->attendee()->create([
        'ticket_type' => '3_days',
        'ticket_quantity' => 1,
        'is_group_ticket' => false,
    ]);
    $group = Registration::factory()->attendee()->create([
        'ticket_type' => '1_day',
        'ticket_quantity' => 4,
        'is_group_ticket' => true,
    ]);

    expect($individual->admitted_people)->toBe(2)
        ->and($group->admitted_people)->toBe(8);
});

it('admits exactly 10 people for the fixed-price group ticket', function (): void {
    $registration = Registration::factory()->attendee()->create([
        'ticket_type' => '3_days',
        'ticket_quantity' => 10,
        'is_group_ticket' => true,
    ]);

    expect($registration->admitted_people)->toBe(10);
});

it('shows the ticket name and admitted people on the success page', function (): void {
    /** @var TestCase $this */
    $registration = Registration::factory()->attendee()->paid()->create([
        'ticket_type' => '3_days',
        'ticket_quantity' => 1,
        'is_group_ticket' => false,
    ]);

    $this->get(route('register.success', $registration->uuid))
        ->assertOk()
        ->assertSee('1× 3 Day Supporter Pass')
        ->assertSee('Admission for')
        ->assertSee('2 people')
        ->assertDontSee('3_days');
});
