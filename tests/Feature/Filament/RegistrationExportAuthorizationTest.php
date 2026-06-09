<?php

declare(strict_types=1);

use App\Filament\Resources\Registrations\Pages\ListRegistrations;
use App\Models\User;
use Filament\Actions\Testing\TestAction;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

test('admins see the export all actions', function (): void {
    actingAs(User::factory()->admin()->create());

    Livewire::test(ListRegistrations::class)
        ->assertActionVisible(TestAction::make('export_all_csv')->table())
        ->assertActionVisible(TestAction::make('export_all_excel')->table());
});

test('ministry managers cannot see the export all actions', function (): void {
    actingAs(User::factory()->ministryManager()->create());

    Livewire::test(ListRegistrations::class)
        ->assertActionHidden(TestAction::make('export_all_csv')->table())
        ->assertActionHidden(TestAction::make('export_all_excel')->table());
});

test('coordinators cannot see the export all actions', function (): void {
    actingAs(User::factory()->coordinator()->create());

    Livewire::test(ListRegistrations::class)
        ->assertActionHidden(TestAction::make('export_all_csv')->table())
        ->assertActionHidden(TestAction::make('export_all_excel')->table());
});
