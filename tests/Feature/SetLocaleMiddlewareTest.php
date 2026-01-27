<?php

use Illuminate\Support\Facades\App;

it('defaults to english locale', function (): void {
    $this->get('/');

    expect(App::getLocale())->toBe('en');
});

it('sets locale from session', function (): void {
    $this->withSession(['locale' => 'hu'])
        ->get('/');

    expect(App::getLocale())->toBe('hu');
});

it('switches locale via lang route', function (): void {
    $response = $this->get(route('lang.switch', 'hu'));

    $response->assertRedirect();
    $response->assertSessionHas('locale', 'hu');
});

it('ignores unsupported locales', function (): void {
    $response = $this->get(route('lang.switch', 'fr'));

    $response->assertRedirect();
    $response->assertSessionMissing('locale');
});

it('only allows supported locales from session', function (): void {
    $this->withSession(['locale' => 'fr'])
        ->get('/');

    expect(App::getLocale())->toBe('en');
});

it('translates content to hungarian when locale is hu', function (): void {
    $this->withSession(['locale' => 'hu'])
        ->get('/');

    expect(__('Home'))->toBe('Kezdolap');
});

it('shows english content by default', function (): void {
    $this->get('/');

    expect(__('Home'))->toBe('Home');
});
