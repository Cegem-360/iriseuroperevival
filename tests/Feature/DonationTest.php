<?php

declare(strict_types=1);

use App\Filament\Resources\Donations\Pages\ListDonations;
use App\Livewire\Pages\Donate;
use App\Models\Donation;
use App\Models\User;
use App\Services\StripeService;
use Livewire\Livewire;
use Stripe\Checkout\Session;
use Tests\TestCase;

it('shows the donation page with the preset amounts and the bank transfer details', function (): void {
    /** @var TestCase $this */
    $this->get(route('donate'))
        ->assertOk()
        ->assertSee('Choose the amount of your donation.')
        ->assertSee('Ararat Alapítvány')
        ->assertSee('HU51 11742135-27251838-00000000')
        ->assertSee('TAMOGATAS')
        ->assertSee('~€25');
});

it('shows the Hungarian copy when the locale is Hungarian', function (): void {
    /** @var TestCase $this */
    $this->withSession(['locale' => 'hu'])
        ->get(route('donate'))
        ->assertOk()
        ->assertSee('Legyél részese, hogy Európa újra lángra lobbanjon Jézusért!')
        ->assertSee('Tovább az adományozáshoz');
});

it('redirects /donate to the Hungarian URL used by the QR code', function (): void {
    /** @var TestCase $this */
    $this->get('/donate')->assertRedirect('/tamogatas');
});

it('creates a pending donation for a preset amount and sends the donor to Stripe', function (): void {
    /** @var TestCase $this */
    $this->mock(StripeService::class)
        ->shouldReceive('createDonationCheckoutSession')
        ->once()
        ->andReturn('https://checkout.stripe.test/donation');

    Livewire::test(Donate::class)
        ->call('selectAmount', 20000)
        ->call('donate')
        ->assertRedirect('https://checkout.stripe.test/donation');

    $donation = Donation::query()->sole();

    expect($donation->amount_huf)->toBe(20000)
        ->and($donation->status)->toBe('pending');
});

it('accepts a custom amount', function (): void {
    /** @var TestCase $this */
    $this->mock(StripeService::class)
        ->shouldReceive('createDonationCheckoutSession')
        ->andReturn('https://checkout.stripe.test/donation');

    Livewire::test(Donate::class)
        ->call('chooseCustom')
        ->set('customAmount', '7500')
        ->call('donate')
        ->assertHasNoErrors();

    expect(Donation::query()->sole()->amount_huf)->toBe(7500);
});

it('rejects a custom amount below the minimum', function (): void {
    Livewire::test(Donate::class)
        ->call('chooseCustom')
        ->set('customAmount', '500')
        ->call('donate')
        ->assertHasErrors(['customAmount' => 'min']);

    expect(Donation::query()->exists())->toBeFalse();
});

it('ignores a preset amount that is not on the page', function (): void {
    Livewire::test(Donate::class)
        ->set('selectedAmount', 3)
        ->call('donate')
        ->assertHasErrors(['customAmount']);

    expect(Donation::query()->exists())->toBeFalse();
});

it('marks the donation paid when the donor returns from a paid Stripe session', function (): void {
    /** @var TestCase $this */
    $donation = Donation::factory()->create(['amount_huf' => 10000, 'stripe_session_id' => 'cs_test_123']);

    $this->partialMock(StripeService::class)
        ->shouldReceive('retrieveSession')
        ->with('cs_test_123')
        ->andReturn(Session::constructFrom([
            'id' => 'cs_test_123',
            'payment_status' => 'paid',
            'payment_intent' => 'pi_test_123',
            'customer_details' => ['name' => 'Kiss Anna', 'email' => 'anna@example.com'],
        ]));

    $this->get(route('donate.success', ['donation' => $donation->uuid, 'session_id' => 'cs_test_123']))
        ->assertOk()
        ->assertSee('Thank you for your donation!');

    $donation->refresh();

    expect($donation->is_paid)->toBeTrue()
        ->and($donation->stripe_payment_intent)->toBe('pi_test_123')
        ->and($donation->name)->toBe('Kiss Anna')
        ->and($donation->email)->toBe('anna@example.com');
});

it('does not mark the donation paid for a session that belongs to another donation', function (): void {
    /** @var TestCase $this */
    $donation = Donation::factory()->create(['stripe_session_id' => 'cs_test_mine']);

    $this->partialMock(StripeService::class)->shouldNotReceive('retrieveSession');

    $this->get(route('donate.success', ['donation' => $donation->uuid, 'session_id' => 'cs_test_other']))
        ->assertOk();

    expect($donation->refresh()->is_paid)->toBeFalse();
});

it('lists donations in the admin panel for admins', function (): void {
    /** @var TestCase $this */
    $paid = Donation::factory()->paid()->create();
    $pending = Donation::factory()->create();

    $this->actingAs(User::factory()->admin()->create());

    Livewire::test(ListDonations::class)
        ->assertCanSeeTableRecords([$paid])
        ->assertCanNotSeeTableRecords([$pending]);
});

it('hides the donations list from non-admin staff', function (): void {
    /** @var TestCase $this */
    $this->actingAs(User::factory()->coordinator()->create())
        ->get(route('filament.admin.resources.donations.index'))
        ->assertForbidden();
});
