<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('loads the cooltix widget script on the home page', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('https://static.cooltix.com/widget.js', false);
});

it('renders cooltix ticket buttons with the configured event id', function () {
    config()->set('services.cooltix.event_id', 'test-event-id');

    $this->get('/')
        ->assertOk()
        ->assertSee('data-cooltix-event-products="test-event-id"', false);
});

it('hides the cooltix widget when no event id is configured', function () {
    config()->set('services.cooltix.event_id', null);

    $this->get('/')
        ->assertOk()
        ->assertDontSee('static.cooltix.com/widget.js', false)
        ->assertDontSee('data-cooltix-event-products', false);
});

it('translates the ticket button label', function () {
    $this->withSession(['locale' => 'hu'])
        ->get('/')
        ->assertOk()
        ->assertSee('Jegyek megtekintése', false);
});
