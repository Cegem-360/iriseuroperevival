<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('embeds the cooltix product iframe for the configured event id', function () {
    config()->set('services.cooltix.event_id', 'test-event-id');

    $this->get('/')
        ->assertOk()
        ->assertSee('https://cooltix.com/widget/event-products/test-event-id', false);
});

it('opens the cooltix modal from the ticket buttons', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('new CustomEvent(\'open-cooltix-modal\')', false)
        ->assertSee('x-on:open-cooltix-modal.window', false);
});

it('hides the cooltix widget when no event id is configured', function () {
    config()->set('services.cooltix.event_id', null);

    $this->get('/')
        ->assertOk()
        ->assertDontSee('cooltix.com/widget/event-products', false)
        ->assertDontSee('open-cooltix-modal', false);
});

it('translates the ticket button label', function () {
    $this->withSession(['locale' => 'hu'])
        ->get('/')
        ->assertOk()
        ->assertSee('Jegyek megtekintése', false)
        ->assertSee('locale=hu', false);
});
