<?php

declare(strict_types=1);

use App\Support\CountryList;

it('lists the full world country list', function (): void {
    $options = CountryList::options();

    expect($options)->toBeArray()
        ->and(count($options))->toBeGreaterThan(190);
});

it('places Hungary first and Other last', function (): void {
    $keys = array_keys(CountryList::options());

    expect($keys[0])->toBe('Hungary')
        ->and(end($keys))->toBe('Other');
});

it('includes distant non-European countries', function (): void {
    $options = CountryList::options();

    expect($options)->toHaveKeys(['Japan', 'Australia', 'Brazil', 'South Africa']);
});

it('does not duplicate priority countries', function (): void {
    $keys = array_keys(CountryList::options());

    expect(array_count_values($keys)['Germany'])->toBe(1)
        ->and(array_count_values($keys)['United States'])->toBe(1);
});
