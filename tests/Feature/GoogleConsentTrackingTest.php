<?php

declare(strict_types=1);

use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    config()->set('services.google.gtm_container_id', 'GTM-TEST123');
});

it('sets consent mode v2 defaults before loading google tag manager', function (): void {
    /** @var TestCase $this */
    $html = $this->get('/')->assertOk()->getContent();

    expect($html)
        ->toContain('gtag(\'consent\', \'default\'')
        ->toContain('ad_user_data: \'denied\'')
        ->toContain('ad_personalization: \'denied\'')
        ->toContain('analytics_storage: \'denied\'')
        ->toContain('googletagmanager.com/gtm.js?id=')
        ->toContain('\'dataLayer\',\'GTM-TEST123\'')
        ->toContain('https://www.googletagmanager.com/ns.html?id=GTM-TEST123')
        ->not->toContain('googletagmanager.com/gtag/js');

    expect(strpos($html, 'gtag(\'consent\', \'default\''))
        ->toBeLessThan(strpos($html, 'googletagmanager.com/gtm.js'));
});

it('renders the cookie banner and footer settings link', function (): void {
    /** @var TestCase $this */
    $this->get('/')->assertOk()->assertSeeHtml('x-on:open-cookie-settings.window')
        ->assertSee('Accept all')
        ->assertSee('Reject all')
        ->assertSee('Cookie Settings');
});

it('pushes begin_checkout when the ticket modal opens', function (): void {
    /** @var TestCase $this */
    $this->get('/')->assertOk()
        ->assertSeeHtml('window.addEventListener(\'open-cooltix-modal\'')
        ->assertSeeHtml('event: \'begin_checkout\'');
});

it('includes the tag on the ministry team layout', function (): void {
    /** @var TestCase $this */
    $this->get(route('ministry-team'))->assertOk()
        ->assertSeeHtml('gtag(\'consent\', \'default\'')
        ->assertSeeHtml('\'dataLayer\',\'GTM-TEST123\'');
});

it('pushes only a lead for an unpaid registration', function (): void {
    /** @var TestCase $this */
    $registration = Registration::factory()->volunteer()->create();

    $this->get(route('register.success', $registration->uuid))
        ->assertOk()
        ->assertSeeHtml('event: \'generate_lead\'')
        ->assertDontSeeHtml('event: \'purchase\'');
});

it('pushes a purchase with ecommerce data for a paid registration', function (): void {
    /** @var TestCase $this */
    $registration = Registration::factory()->attendee()->paid()->create(['amount' => 1500000]);

    $this->get(route('register.success', $registration->uuid))
        ->assertOk()
        ->assertSeeHtml('window.dataLayer.push({ ecommerce: null });')
        ->assertSeeHtml('event: \'purchase\'')
        ->assertSeeHtml("transaction_id: '{$registration->uuid}'")
        ->assertSeeHtml('value: 15000');
});

it('renders no google tag or banner when no container is configured', function (): void {
    /** @var TestCase $this */
    config()->set('services.google.gtm_container_id', null);

    $this->get('/')->assertOk()->assertDontSeeHtml('googletagmanager.com')->assertDontSeeHtml('open-cookie-settings');
});

it('translates the cookie banner', function (): void {
    /** @var TestCase $this */
    $this->withSession(['locale' => 'hu'])
        ->get('/')
        ->assertOk()
        ->assertSee('Összes elfogadása')
        ->assertSee('Süti beállítások');
});

it('ships the production container id only for the production environment', function (): void {
    $services = fn (string $environment): array => (function () use ($environment): array {
        $previous = $_ENV['APP_ENV'] ?? null;
        $_ENV['APP_ENV'] = $_SERVER['APP_ENV'] = $environment;
        putenv("APP_ENV={$environment}");

        try {
            return (require config_path('services.php'))['google'];
        } finally {
            $_ENV['APP_ENV'] = $_SERVER['APP_ENV'] = $previous;
            putenv('APP_ENV=' . $previous);
        }
    })();

    expect($services('production'))->gtm_container_id->toBe('GTM-WXGLNB4X');
    expect($services('local'))->gtm_container_id->toBeNull();
});
