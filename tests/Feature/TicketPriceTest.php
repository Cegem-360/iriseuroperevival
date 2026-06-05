<?php

declare(strict_types=1);

use App\Filament\Resources\TicketPrices\Pages\CreateTicketPrice;
use App\Filament\Resources\TicketPrices\Pages\EditTicketPrice;
use App\Filament\Resources\TicketPrices\Pages\ListTicketPrices;
use App\Models\TicketPrice;
use App\Models\User;
use App\Services\StripeService;
use Livewire\Livewire;

beforeEach(function () {
    $this->actingAs(User::factory()->admin()->create());
    TicketPrice::query()->delete();
});

it('has correct computed attributes', function () {
    $ticketPrice = TicketPrice::factory()->create(['price' => 4900]);

    expect($ticketPrice->price_in_huf)->toEqual(49)
        ->and($ticketPrice->formatted_price)->toContain('49')
        ->and($ticketPrice->formatted_price)->toContain('HUF');
});

it('scopes active ticket prices', function () {
    TicketPrice::factory()->create(['is_active' => true, 'pricing_tier' => 'early', 'ticket_type' => 'individual']);
    TicketPrice::factory()->inactive()->create(['pricing_tier' => 'early', 'ticket_type' => 'team']);

    expect(TicketPrice::query()->active()->count())->toBe(1);
});

it('scopes by tier and type', function () {
    TicketPrice::factory()->early()->individual()->create();
    TicketPrice::factory()->regular()->team()->create();

    expect(TicketPrice::query()->forTier('early')->count())->toBe(1)
        ->and(TicketPrice::query()->forType('team')->count())->toBe(1);
});

it('auto-generates uuid on creation', function () {
    $ticketPrice = TicketPrice::factory()->create(['uuid' => null]);

    expect($ticketPrice->uuid)->not->toBeNull()
        ->and($ticketPrice->uuid)->toBeString();
});

it('stripe service reads price from database', function () {
    TicketPrice::factory()->early()->individual()->create(['price' => 5500]);

    $service = new StripeService();

    expect($service->getTicketPrice('individual', 'early'))->toBe(5500);
});

it('stripe service falls back to hardcoded prices when no db record', function () {
    $service = new StripeService();

    expect($service->getTicketPrice('individual', 'early'))->toBe(4900);
});

it('can list ticket prices in filament', function () {
    $prices = TicketPrice::factory()->count(3)->sequence(
        ['pricing_tier' => 'early', 'ticket_type' => 'individual'],
        ['pricing_tier' => 'regular', 'ticket_type' => 'team'],
        ['pricing_tier' => 'late', 'ticket_type' => 'vip'],
    )->create();

    Livewire::test(ListTicketPrices::class)
        ->assertCanSeeTableRecords($prices);
});

it('can create a ticket price in filament', function () {
    Livewire::test(CreateTicketPrice::class)
        ->fillForm([
            'ticket_type' => 'individual',
            'pricing_tier' => 'early',
            'price' => 49,
            'label' => 'Standard Ticket',
            'is_active' => true,
            'sort_order' => 0,
        ])
        ->call('create')
        ->assertNotified()
        ->assertRedirect();

    $this->assertDatabaseHas('ticket_prices', [
        'ticket_type' => 'individual',
        'pricing_tier' => 'early',
        'price' => 4900,
    ]);
});

it('can edit a ticket price in filament', function () {
    $ticketPrice = TicketPrice::factory()->create([
        'price' => 4900,
        'ticket_type' => 'individual',
        'pricing_tier' => 'early',
    ]);

    Livewire::test(EditTicketPrice::class, ['record' => $ticketPrice->id])
        ->fillForm(['price' => 55])
        ->call('save')
        ->assertNotified();

    expect($ticketPrice->fresh()->price)->toBe(5500);
});

it('validates required fields on create', function () {
    Livewire::test(CreateTicketPrice::class)
        ->fillForm([
            'ticket_type' => null,
            'pricing_tier' => null,
            'price' => null,
            'label' => null,
        ])
        ->call('create')
        ->assertHasFormErrors([
            'ticket_type' => 'required',
            'pricing_tier' => 'required',
            'price' => 'required',
            'label' => 'required',
        ]);
});
