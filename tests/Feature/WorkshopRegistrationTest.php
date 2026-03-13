<?php

declare(strict_types=1);

use App\Models\Registration;
use App\Models\Workshop;

it('can attach workshops to a registration', function (): void {
    $workshop = Workshop::factory()->create(['date' => '2026-07-10', 'capacity' => 20]);
    $registration = Registration::factory()->attendee()->create();

    $registration->workshops()->attach($workshop);

    expect($registration->workshops)->toHaveCount(1);
    expect($registration->workshops->first()->id)->toBe($workshop->id);
});

it('detects when a workshop is at capacity', function (): void {
    $workshop = Workshop::factory()->create(['date' => '2026-07-10', 'capacity' => 10]);

    // 11 registrations = ceil(10 * 1.1) = 11, so at capacity
    $registrations = Registration::factory()->attendee()->count(11)->create();
    $workshop->registrations()->attach($registrations->pluck('id'));

    expect($workshop->isAtCapacity())->toBeTrue();
});

it('allows registrations under capacity plus ten percent', function (): void {
    $workshop = Workshop::factory()->create(['date' => '2026-07-10', 'capacity' => 10]);

    // 10 registrations, max allowed is 11
    $registrations = Registration::factory()->attendee()->count(10)->create();
    $workshop->registrations()->attach($registrations->pluck('id'));

    expect($workshop->isAtCapacity())->toBeFalse();
});

it('stores wants_to_evangelize on registration', function (): void {
    $registration = Registration::factory()->attendee()->create([
        'wants_to_evangelize' => true,
    ]);

    expect($registration->fresh()->wants_to_evangelize)->toBeTrue();
});

it('stores workshop date correctly', function (): void {
    $workshop = Workshop::factory()->create(['date' => '2026-07-10']);

    expect($workshop->fresh()->date->format('Y-m-d'))->toBe('2026-07-10');
});
