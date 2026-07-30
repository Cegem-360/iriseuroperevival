<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Filament\Resources\Registrations\Pages\EditRegistration;
use App\Filament\Resources\Registrations\Pages\ListRegistrations;
use App\Models\Registration;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

beforeEach(function (): void {
    actingAs(User::factory()->admin()->create());
});

describe('volunteer application fields', function (): void {
    it('shows the service areas a volunteer applied for', function (): void {
        $registration = Registration::factory()->volunteer()->create([
            'service_areas' => ['Childcare', 'Translators'],
            'has_served_before' => true,
            'previous_service_description' => 'Served at a youth camp',
        ]);

        Livewire::test(EditRegistration::class, ['record' => $registration->uuid])
            ->assertFormFieldVisible('service_areas')
            ->assertFormSet([
                'service_areas' => ['Childcare', 'Translators'],
                'has_served_before' => true,
                'previous_service_description' => 'Served at a youth camp',
            ]);
    });

    it('lets an admin change the service areas', function (): void {
        $registration = Registration::factory()->volunteer()->create([
            'service_areas' => ['Childcare'],
        ]);

        Livewire::test(EditRegistration::class, ['record' => $registration->uuid])
            ->fillForm(['service_areas' => ['Ushers', 'Merch']])
            ->call('save')
            ->assertHasNoFormErrors();

        expect($registration->refresh()->service_areas)->toBe(['Ushers', 'Merch']);
    });

    it('hides the volunteer fields for an attendee', function (): void {
        $registration = Registration::factory()->attendee()->create();

        Livewire::test(EditRegistration::class, ['record' => $registration->uuid])
            ->assertFormFieldHidden('service_areas')
            ->assertFormFieldVisible('ticket_type');
    });

    it('hides ticket and ministry fields for a volunteer', function (): void {
        $registration = Registration::factory()->volunteer()->create();

        Livewire::test(EditRegistration::class, ['record' => $registration->uuid])
            ->assertFormFieldHidden('ticket_type')
            ->assertFormFieldHidden('amount')
            ->assertFormFieldHidden('ministry_areas');
    });

    it('keeps the service areas untouched when saving unrelated fields', function (): void {
        $registration = Registration::factory()->volunteer()->create([
            'service_areas' => ['Hospitality'],
        ]);

        Livewire::test(EditRegistration::class, ['record' => $registration->uuid])
            ->fillForm(['city' => 'Debrecen'])
            ->call('save')
            ->assertHasNoFormErrors();

        $registration->refresh();

        expect($registration->service_areas)->toBe(['Hospitality'])
            ->and($registration->city)->toBe('Debrecen');
    });
});

describe('registrations table', function (): void {
    it('shows the service areas column without toggling it on', function (): void {
        $registration = Registration::factory()->volunteer()->create([
            'service_areas' => ['Childcare'],
        ]);

        Livewire::test(ListRegistrations::class)
            ->assertTableColumnVisible('service_areas')
            ->assertTableColumnStateSet('service_areas', ['Childcare'], $registration);
    });

    it('still renders every grouped column when all are toggled on', function (): void {
        $registrations = Registration::factory()->volunteer()->count(2)->create();

        Livewire::test(ListRegistrations::class)
            ->set('activeTab', 'volunteers')
            ->toggleAllTableColumns()
            ->assertCanSeeTableRecords($registrations);
    });
});

describe('registrations list tabs', function (): void {
    it('scopes each tab to its registration type', function (): void {
        $attendee = Registration::factory()->attendee()->create();
        $volunteer = Registration::factory()->volunteer()->create();
        $ministry = Registration::factory()->ministry()->create();

        $component = Livewire::test(ListRegistrations::class);

        $component->set('activeTab', 'volunteers')
            ->assertCanSeeTableRecords([$volunteer])
            ->assertCanNotSeeTableRecords([$attendee, $ministry]);

        $component->set('activeTab', 'attendees')
            ->assertCanSeeTableRecords([$attendee])
            ->assertCanNotSeeTableRecords([$volunteer, $ministry]);

        $component->set('activeTab', 'ministry')
            ->assertCanSeeTableRecords([$ministry])
            ->assertCanNotSeeTableRecords([$attendee, $volunteer]);

        $component->set('activeTab', 'all')
            ->assertCanSeeTableRecords([$attendee, $volunteer, $ministry]);
    });

    it('scopes the approval tab to applications awaiting a decision', function (): void {
        $pending = Registration::factory()->volunteer()->create(['status' => 'pending_approval']);
        $approved = Registration::factory()->volunteer()->approved()->create();

        Livewire::test(ListRegistrations::class)
            ->set('activeTab', 'pending_approval')
            ->assertCanSeeTableRecords([$pending])
            ->assertCanNotSeeTableRecords([$approved]);
    });

    it('hides the attendees tab from staff limited to applications', function (): void {
        actingAs(User::factory()->create(['role' => UserRole::MinistryManager]));

        $tabs = array_keys(Livewire::test(ListRegistrations::class)->instance()->getTabs());

        expect($tabs)->not->toContain('attendees')
            ->and($tabs)->toContain('volunteers')
            ->and($tabs)->toContain('ministry');
    });
});
