<?php

declare(strict_types=1);

use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    config()->set('services.google', [
        'ga4_measurement_id' => 'G-TEST123',
        'ads_id' => 'AW-987654',
        'ads_registration_label' => 'regLabel',
        'ads_ticket_label' => 'ticketLabel',
    ]);
});

it('sets consent mode v2 defaults before loading the google tag', function (): void {
    /** @var TestCase $this */
    $html = $this->get('/')->assertOk()->getContent();

    expect($html)
        ->toContain('gtag(\'consent\', \'default\'')
        ->toContain('ad_user_data: \'denied\'')
        ->toContain('ad_personalization: \'denied\'')
        ->toContain('analytics_storage: \'denied\'')
        ->toContain('https://www.googletagmanager.com/gtag/js?id=G-TEST123')
        ->toContain('gtag(\'config\', \'G-TEST123\')')
        ->toContain('gtag(\'config\', \'AW-987654\')');

    expect(strpos($html, 'gtag(\'consent\', \'default\''))
        ->toBeLessThan(strpos($html, 'googletagmanager.com/gtag/js'));
});

it('renders the cookie banner and footer settings link', function (): void {
    /** @var TestCase $this */
    $this->get('/')
        ->assertOk()
        ->assertSee('x-on:open-cookie-settings.window', false)
        ->assertSee('Accept all')
        ->assertSee('Reject all')
        ->assertSee('Cookie Settings');
});

it('fires the ads ticket conversion when the ticket modal opens', function (): void {
    /** @var TestCase $this */
    $this->get('/')
        ->assertOk()
        ->assertSee('window.addEventListener(\'open-cooltix-modal\'', false)
        ->assertSee("send_to: 'AW-987654\/ticketLabel'", false);
});

it('includes the tag on the ministry team layout', function (): void {
    /** @var TestCase $this */
    $this->get(route('ministry-team'))
        ->assertOk()
        ->assertSee('gtag(\'consent\', \'default\'', false);
});

it('tracks only a lead for an unpaid registration', function () {
    $registration = Registration::factory()->volunteer()->create();

    $this->get(route('register.success', $registration->uuid))
        ->assertOk()
        ->assertSee('gtag(\'event\', \'generate_lead\'', false)
        ->assertDontSee('gtag(\'event\', \'purchase\'', false)
        ->assertDontSee('regLabel', false);
});

it('fires the purchase conversion for a paid registration', function () {
    config()->set('services.google.ads_id', 'AW-18466287510');
    config()->set('services.google.ads_registration_label', 'AbLfCKnylYodEJbftOVE');

    $registration = Registration::factory()->attendee()->paid()->create(['amount' => 1500000]);

    $this->get(route('register.success', $registration->uuid))
        ->assertOk()
        ->assertSee('gtag(\'event\', \'purchase\'', false)
        ->assertSee('send_to: \'AW-18466287510\\/AbLfCKnylYodEJbftOVE\'', false)
        ->assertSee("transaction_id: '{$registration->uuid}'", false)
        ->assertSee('value: 15000', false);
});

it('renders no google tag or banner when nothing is configured', function (): void {
    /** @var TestCase $this */
    config()->set('services.google', [
        'ga4_measurement_id' => null,
        'ads_id' => null,
        'ads_registration_label' => null,
        'ads_ticket_label' => null,
    ]);

    $this->get('/')
        ->assertOk()
        ->assertDontSee('googletagmanager.com', false)
        ->assertDontSee('open-cookie-settings', false);
});

it('translates the cookie banner', function (): void {
    /** @var TestCase $this */
    $this->withSession(['locale' => 'hu'])
        ->get('/')
        ->assertOk()
        ->assertSee('Összes elfogadása')
        ->assertSee('Süti beállítások');
});
