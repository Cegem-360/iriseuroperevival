<?php

declare(strict_types=1);

use App\Filament\Resources\Registrations\Pages\ListRegistrations;
use App\Models\Registration;
use App\Models\User;
use Filament\Actions\Testing\TestAction;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

test('the contact reference 1 action is visible when the reference is pending', function (): void {
    actingAs(User::factory()->admin()->create());

    $registration = Registration::factory()->ministry()->create([
        'reference_1_email' => 'pastor@example.com',
        'reference_1_status' => 'pending',
    ]);

    Livewire::test(ListRegistrations::class)
        ->assertActionVisible(TestAction::make('contact_reference_1')->table($registration));
});

test('the contact reference 1 action is hidden when the reference is approved', function (): void {
    actingAs(User::factory()->admin()->create());

    $registration = Registration::factory()->ministry()->create([
        'reference_1_email' => 'pastor@example.com',
        'reference_1_status' => 'approved',
    ]);

    Livewire::test(ListRegistrations::class)
        ->assertActionHidden(TestAction::make('contact_reference_1')->table($registration));
});

test('the contact reference 1 action is hidden when the reference is rejected', function (): void {
    actingAs(User::factory()->admin()->create());

    $registration = Registration::factory()->ministry()->create([
        'reference_1_email' => 'pastor@example.com',
        'reference_1_status' => 'rejected',
    ]);

    Livewire::test(ListRegistrations::class)
        ->assertActionHidden(TestAction::make('contact_reference_1')->table($registration));
});
