<?php

declare(strict_types=1);

use App\Models\Registration;
use App\Services\StripeService;

it('does nothing when no test registrations exist', function (): void {
    $this->mock(StripeService::class)
        ->shouldNotReceive('refund');

    $this->artisan('registrations:purge-tests', ['--force' => true])
        ->expectsOutput('No test registrations found.')
        ->assertSuccessful();
});

it('lists but does not touch anything in dry-run mode', function (): void {
    $this->mock(StripeService::class)
        ->shouldNotReceive('refund');

    $test = Registration::factory()->create([
        'is_test' => true,
        'paid_at' => now(),
        'stripe_payment_intent' => 'pi_test_1',
    ]);

    $this->artisan('registrations:purge-tests', ['--dry-run' => true])
        ->assertSuccessful();

    expect(Registration::query()->find($test->id))->not->toBeNull();
});

it('refunds paid test registrations and deletes them, leaving production rows alone', function (): void {
    $paidTest = Registration::factory()->create([
        'is_test' => true,
        'paid_at' => now(),
        'stripe_payment_intent' => 'pi_test_paid',
    ]);

    $unpaidTest = Registration::factory()->create([
        'is_test' => true,
        'paid_at' => null,
        'stripe_payment_intent' => null,
    ]);

    $production = Registration::factory()->create([
        'is_test' => false,
        'paid_at' => now(),
        'stripe_payment_intent' => 'pi_live_real',
    ]);

    $this->mock(StripeService::class)
        ->shouldReceive('refund')
        ->once()
        ->withArgs(fn (Registration $r): bool => $r->is($paidTest))
        ->andReturn(true);

    $this->artisan('registrations:purge-tests', ['--force' => true])
        ->assertSuccessful();

    expect(Registration::query()->find($paidTest->id))->toBeNull()
        ->and(Registration::query()->find($unpaidTest->id))->toBeNull()
        ->and(Registration::query()->find($production->id))->not->toBeNull();
});

it('keeps the registration when the refund fails', function (): void {
    $paidTest = Registration::factory()->create([
        'is_test' => true,
        'paid_at' => now(),
        'stripe_payment_intent' => 'pi_test_fail',
    ]);

    $this->mock(StripeService::class)
        ->shouldReceive('refund')
        ->once()
        ->andReturn(false);

    $this->artisan('registrations:purge-tests', ['--force' => true])
        ->assertExitCode(1);

    expect(Registration::query()->find($paidTest->id))->not->toBeNull();
});
