<?php

declare(strict_types=1);

it('shows the Hungarian data controller details', function (): void {
    session(['locale' => 'hu']);

    $this->get(route('privacy'))
        ->assertOk()
        ->assertSee('Az Adatkezelő megnevezése')
        ->assertSee('Centrum Misyjne Iris Global')
        ->assertSee('6751770612')
        ->assertSee('Dominika Mofele')
        ->assertSee('contact@iriskrakow.org')
        ->assertDontSee('[Szervező szervezet neve]');
});

it('shows the full English GDPR policy with the same data controller', function (): void {
    session(['locale' => 'en']);

    $this->get(route('privacy'))
        ->assertOk()
        ->assertSee('Identification of the Data Controller')
        ->assertSee('Centrum Misyjne Iris Global')
        ->assertSee('6751770612')
        ->assertSee('Rights of the data subject')
        ->assertSee('contact@iriskrakow.org');
});
