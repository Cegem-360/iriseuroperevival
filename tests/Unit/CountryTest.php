<?php

declare(strict_types=1);

use App\Enums\Country;

it('covers the full world country list', function (): void {
    expect(Country::count())->toBeGreaterThan(190)
        ->and(Country::count())->toBe(count(Country::cases()));
});

it('places Hungary first and Other last', function (): void {
    $cases = Country::cases();

    expect($cases[0])->toBe(Country::Hungary)
        ->and(end($cases))->toBe(Country::Other);
});

it('includes distant non-European countries', function (): void {
    expect(Country::tryFrom('Japan'))->toBe(Country::Japan)
        ->and(Country::tryFrom('Australia'))->toBe(Country::Australia)
        ->and(Country::tryFrom('Brazil'))->toBe(Country::Brazil)
        ->and(Country::tryFrom('South Africa'))->toBe(Country::SouthAfrica);
});
