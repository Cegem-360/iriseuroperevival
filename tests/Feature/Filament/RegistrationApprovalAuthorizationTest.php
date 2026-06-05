<?php

declare(strict_types=1);

use App\Filament\Resources\Registrations\Pages\ListRegistrations;
use App\Models\Registration;
use App\Models\User;
use Filament\Actions\Testing\TestAction;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

function pendingMinistryRegistration(): Registration
{
    return Registration::factory()->create([
        'type' => 'ministry',
        'status' => 'pending_approval',
    ]);
}

test('admins see the approve and reject actions', function (): void {
    actingAs(User::factory()->admin()->create());
    $registration = pendingMinistryRegistration();

    Livewire::test(ListRegistrations::class)
        ->assertActionVisible(TestAction::make('approve')->table($registration))
        ->assertActionVisible(TestAction::make('reject')->table($registration));
});

test('ministry managers see the approve and reject actions', function (): void {
    actingAs(User::factory()->ministryManager()->create());
    $registration = pendingMinistryRegistration();

    Livewire::test(ListRegistrations::class)
        ->assertActionVisible(TestAction::make('approve')->table($registration))
        ->assertActionVisible(TestAction::make('reject')->table($registration));
});

test('coordinators cannot see the approve or reject actions', function (): void {
    actingAs(User::factory()->coordinator()->create());
    $registration = pendingMinistryRegistration();

    Livewire::test(ListRegistrations::class)
        ->assertActionHidden(TestAction::make('approve')->table($registration))
        ->assertActionHidden(TestAction::make('reject')->table($registration));
});
