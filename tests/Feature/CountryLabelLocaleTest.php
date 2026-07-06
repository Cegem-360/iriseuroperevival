<?php

declare(strict_types=1);

use App\Enums\Country;

it('localizes the label to Hungarian when the locale is hu', function (): void {
    app()->setLocale('hu');

    expect(Country::Hungary->getLabel())->toBe('Magyarország')
        ->and(Country::CzechRepublic->getLabel())->toBe('Csehország')
        ->and(Country::UnitedStates->getLabel())->toBe('Amerikai Egyesült Államok')
        ->and(Country::Other->getLabel())->toBe('Egyéb');
});

it('falls back to the English name when the locale has no translation', function (): void {
    app()->setLocale('de');

    expect(Country::Hungary->getLabel())->toBe('Hungary')
        ->and(Country::UnitedStates->getLabel())->toBe('United States');
});

it('uses the English name in the default locale', function (): void {
    app()->setLocale('en');

    expect(Country::Hungary->getLabel())->toBe('Hungary')
        ->and(Country::CzechRepublic->getLabel())->toBe('Czech Republic');
});
