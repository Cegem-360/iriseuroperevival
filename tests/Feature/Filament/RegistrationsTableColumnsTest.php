<?php

declare(strict_types=1);

use App\Filament\Resources\Registrations\Pages\EditRegistration;
use App\Filament\Resources\Registrations\Pages\ListRegistrations;
use App\Models\Registration;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

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

test('the registrations table shows the email language column', function (): void {
    actingAs(User::factory()->admin()->create());
    $registration = Registration::factory()->create(['locale' => 'hu']);

    Livewire::test(ListRegistrations::class)
        ->assertCanSeeTableRecords([$registration])
        ->assertTableColumnStateSet('locale', 'hu', $registration);
});

test('an admin can change the email language from the edit form', function (): void {
    actingAs(User::factory()->admin()->create());
    $registration = Registration::factory()->create(['locale' => 'en']);

    Livewire::test(EditRegistration::class, ['record' => $registration->uuid])
        ->fillForm(['locale' => 'hu'])
        ->call('save')
        ->assertHasNoFormErrors();

    assertDatabaseHas(Registration::class, [
        'id' => $registration->id,
        'locale' => 'hu',
    ]);
});
