<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(RefreshDatabase::class);

it('embeds the cooltix product iframe for the configured event id', function (): void {
    /** @var TestCase $this */
    config()->set('services.cooltix.event_id', 'test-event-id');

    $this->get('/')->assertOk()->assertSeeHtml('https://cooltix.com/widget/event-products/test-event-id');
});

it('opens the cooltix modal from the ticket buttons', function (): void {
    /** @var TestCase $this */
    config()->set('services.cooltix.event_id', 'test-event-id');

    $this->get('/')->assertOk()->assertSeeHtml('new CustomEvent(\'open-cooltix-modal\')')->assertSeeHtml('x-on:open-cooltix-modal.window');
});

it('hides the cooltix widget when no event id is configured', function (): void {
    /** @var TestCase $this */
    config()->set('services.cooltix.event_id');

    $this->get('/')->assertOk()->assertDontSeeHtml('cooltix.com/widget/event-products')->assertDontSeeHtml('open-cooltix-modal');
});

it('is disabled by default when the COOLTIX_EVENT_ID env var is absent', function (): void {
    /** @var TestCase $this */
    expect(config('services.cooltix.event_id'))->toBeNull();

    $this->get('/')->assertOk()->assertDontSeeHtml('cooltix.com/widget/event-products')->assertDontSeeHtml('open-cooltix-modal');
});

it('translates the ticket button label', function (): void {
    /** @var TestCase $this */
    config()->set('services.cooltix.event_id', 'test-event-id');

    $this->withSession(['locale' => 'hu'])
        ->get('/')->assertOk()->assertSeeHtml('Jegyek megtekintése')->assertSeeHtml('locale=hu');
});
