<?php

declare(strict_types=1);

use App\Livewire\Pages\RegisterCancel;
use App\Models\Registration;
use App\Services\StripeService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Livewire;

it('renders the cancel page for a valid registration', function () {
    $registration = Registration::factory()->attendee()->create();

    Livewire::test(RegisterCancel::class, ['uuid' => $registration->uuid])
        ->assertStatus(200)
        ->assertSee('Payment Cancelled')
        ->assertSee($registration->full_name)
        ->assertSee($registration->email);
});

it('throws ModelNotFoundException for an invalid uuid', function () {
    Livewire::test(RegisterCancel::class, ['uuid' => 'non-existent-uuid']);
})->throws(ModelNotFoundException::class);

it('calls StripeService and redirects on retry payment', function () {
    $registration = Registration::factory()->attendee()->create();

    $mock = Mockery::mock(StripeService::class);
    $mock->shouldReceive('createCheckoutSession')
        ->once()
        ->with(Mockery::on(fn ($reg) => $reg->id === $registration->id))
        ->andReturn('https://checkout.stripe.com/test-session');

    app()->instance(StripeService::class, $mock);

    Livewire::test(RegisterCancel::class, ['uuid' => $registration->uuid])
        ->call('retryPayment')
        ->assertRedirect('https://checkout.stripe.com/test-session');
});
