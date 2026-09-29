<?php

declare(strict_types=1);

use Illuminate\Support\Facades\App;
use Tests\TestCase;

it('defaults to english locale', function (): void {
    /** @var TestCase $this */
    $this->get('/');

    expect(App::getLocale())->toBe('en');
});

it('sets locale from session', function (): void {
    /** @var TestCase $this */
    $this->withSession(['locale' => 'hu'])
        ->get('/');

    expect(App::getLocale())->toBe('hu');
});

it('switches locale via lang route', function (): void {
    /** @var TestCase $this */
    $response = $this->get(route('lang.switch', 'hu'));

    $response->assertRedirect();
    $response->assertSessionHas('locale', 'hu');
});

it('ignores unsupported locales', function (): void {
    /** @var TestCase $this */
    $response = $this->get(route('lang.switch', 'fr'));

    $response->assertRedirect();
    $response->assertSessionMissing('locale');
});

it('only allows supported locales from session', function (): void {
    /** @var TestCase $this */
    $this->withSession(['locale' => 'fr'])
        ->get('/');

    expect(App::getLocale())->toBe('en');
});

it('translates content to hungarian when locale is hu', function (): void {
    /** @var TestCase $this */
    $this->withSession(['locale' => 'hu'])
        ->get('/');

    expect(__('Home'))->toBe('Kezdőlap');
});

it('shows english content by default', function (): void {
    /** @var TestCase $this */
    $this->get('/');

    expect(__('Home'))->toBe('Home');
});
