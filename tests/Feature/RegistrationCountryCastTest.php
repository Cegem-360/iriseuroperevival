<?php

declare(strict_types=1);

use App\Enums\Country;
use App\Models\Registration;
use Tests\TestCase;

it('casts the country attribute to the Country enum', function (): void {
    /** @var TestCase $this */
    $registration = Registration::factory()->create(['country' => 'Hungary']);

    expect($registration->refresh()->country)->toBe(Country::Hungary);

    $this->assertDatabaseHas(Registration::class, [
        'id' => $registration->id,
        'country' => 'Hungary',
    ]);
});
