<?php

declare(strict_types=1);

use App\Filament\Pages\Dashboard;
use App\Filament\Resources\Registrations\Pages\ListRegistrations;
use App\Filament\Resources\Registrations\RegistrationResource;
use App\Filament\Widgets\PendingApprovalsWidget;
use App\Models\Registration;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

test('restricted staff cannot reach resources outside registrations', function (string $state, string $route): void {
    actingAs(User::factory()->{$state}()->create());

    $this->get(route($route))->assertForbidden();
})->with([
    'ministry manager / speakers' => ['ministryManager', 'filament.admin.resources.speakers.index'],
    'ministry manager / orders' => ['ministryManager', 'filament.admin.resources.orders.index'],
    'coordinator / speakers' => ['coordinator', 'filament.admin.resources.speakers.index'],
    'coordinator / ticket prices' => ['coordinator', 'filament.admin.resources.ticket-prices.index'],
]);

test('admins can reach resources outside registrations', function (): void {
    actingAs(User::factory()->admin()->create());

    $this->get(route('filament.admin.resources.speakers.index'))->assertOk();
});

test('restricted staff can reach the registrations resource', function (string $state): void {
    actingAs(User::factory()->{$state}()->create());

    $this->get(route('filament.admin.resources.registrations.index'))->assertOk();
})->with(['ministryManager', 'coordinator']);

test('restricted staff only see ministry and volunteer registrations', function (string $state): void {
    actingAs(User::factory()->{$state}()->create());

    $ministry = Registration::factory()->create(['type' => 'ministry', 'status' => 'pending_approval']);
    $volunteer = Registration::factory()->create(['type' => 'volunteer', 'status' => 'pending_approval']);
    $attendee = Registration::factory()->create(['type' => 'attendee', 'status' => 'pending_payment']);

    Livewire::test(ListRegistrations::class)
        ->assertCanSeeTableRecords([$ministry, $volunteer])
        ->assertCanNotSeeTableRecords([$attendee]);
})->with(['ministryManager', 'coordinator']);

test('admins see every registration type', function (): void {
    actingAs(User::factory()->admin()->create());

    $ministry = Registration::factory()->create(['type' => 'ministry', 'status' => 'pending_approval']);
    $attendee = Registration::factory()->create(['type' => 'attendee', 'status' => 'pending_payment']);

    Livewire::test(ListRegistrations::class)
        ->assertCanSeeTableRecords([$ministry, $attendee]);
});

test('only ministry managers and admins may create or edit registrations', function (): void {
    $registration = Registration::factory()->create(['type' => 'ministry', 'status' => 'pending_approval']);

    actingAs(User::factory()->admin()->create());
    expect(RegistrationResource::canCreate())->toBeTrue()
        ->and(RegistrationResource::canEdit($registration))->toBeTrue();

    actingAs(User::factory()->ministryManager()->create());
    expect(RegistrationResource::canCreate())->toBeTrue()
        ->and(RegistrationResource::canEdit($registration))->toBeTrue();

    actingAs(User::factory()->coordinator()->create());
    expect(RegistrationResource::canCreate())->toBeFalse()
        ->and(RegistrationResource::canEdit($registration))->toBeFalse();
});

test('only admins may delete registrations', function (): void {
    $registration = Registration::factory()->create();

    actingAs(User::factory()->admin()->create());
    expect(RegistrationResource::canDelete($registration))->toBeTrue();

    actingAs(User::factory()->ministryManager()->create());
    expect(RegistrationResource::canDelete($registration))->toBeFalse();
});

test('restricted staff dashboards show only the pending approvals widget', function (string $state): void {
    actingAs(User::factory()->{$state}()->create());

    expect((new Dashboard())->getWidgets())->toBe([PendingApprovalsWidget::class]);
})->with(['ministryManager', 'coordinator']);

test('admin dashboard includes the pending approvals widget among others', function (): void {
    actingAs(User::factory()->admin()->create());

    $widgets = (new Dashboard())->getWidgets();

    expect($widgets)->toContain(PendingApprovalsWidget::class)
        ->and(count($widgets))->toBeGreaterThan(1);
});
