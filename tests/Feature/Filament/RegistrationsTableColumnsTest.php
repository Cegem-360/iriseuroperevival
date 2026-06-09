<?php

declare(strict_types=1);

use App\Filament\Resources\Registrations\Pages\ListRegistrations;
use App\Models\Registration;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

test('the registrations table renders with records visible', function (): void {
    actingAs(User::factory()->admin()->create());
    $registrations = Registration::factory()->count(3)->create();

    Livewire::test(ListRegistrations::class)
        ->assertCanSeeTableRecords($registrations);
});

test('the registrations table can toggle all columns on without error', function (): void {
    actingAs(User::factory()->admin()->create());
    $registrations = Registration::factory()->ministry()->count(3)->create();

    Livewire::test(ListRegistrations::class)
        ->toggleAllTableColumns()
        ->assertCanSeeTableRecords($registrations);
});
