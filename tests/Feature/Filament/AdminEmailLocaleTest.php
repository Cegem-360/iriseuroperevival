<?php

declare(strict_types=1);

use BezhanSalleh\LanguageSwitch\Http\Middleware\SwitchLanguageLocale;
use Illuminate\Support\Facades\App;
use Livewire\Livewire;

it('switches the app locale to the language selected in the admin', function (): void {
    App::setLocale('en');
    session(['locale' => 'hu']);

    (new SwitchLanguageLocale())->handle(request(), fn ($request) => $request);

    expect(App::getLocale())->toBe('hu');
});

it('registers the locale middleware as persistent so it runs on livewire update requests', function (): void {
    expect(Livewire::getPersistentMiddleware())->toContain(SwitchLanguageLocale::class);
});
