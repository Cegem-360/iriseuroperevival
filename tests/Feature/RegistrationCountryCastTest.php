<?php

declare(strict_types=1);

use App\Enums\Country;
use App\Models\Registration;

it('casts the country attribute to the Country enum', function (): void {
    $registration = Registration::factory()->create(['country' => 'Hungary']);

    expect($registration->refresh()->country)->toBe(Country::Hungary);

    $this->assertDatabaseHas(Registration::class, [
        'id' => $registration->id,
        'country' => 'Hungary',
    ]);
});
