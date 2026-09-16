<?php

declare(strict_types=1);

use App\Mail\MinistryApplicationApproved;
use App\Models\Registration;
use Illuminate\Support\Facades\App;

it('renders the approved email in english when the locale is en', function (): void {
    App::setLocale('en');

    $registration = Registration::factory()->create([
        'type' => 'ministry',
        'first_name' => 'Jane',
        'status' => 'approved',
    ]);

    $mailable = new MinistryApplicationApproved($registration);

    $mailable->assertSeeInHtml('Your Application Has Been Approved!');
    $mailable->assertDontSeeInHtml('A jelentkezésedet jóváhagytuk!');
});

it('renders the approved email in hungarian when the locale is hu', function (): void {
    App::setLocale('hu');

    $registration = Registration::factory()->create([
        'type' => 'ministry',
        'first_name' => 'Jane',
        'status' => 'approved',
    ]);

    $mailable = new MinistryApplicationApproved($registration);

    $mailable->assertSeeInHtml('A jelentkezésedet jóváhagytuk!');
    $mailable->assertDontSeeInHtml('Your Application Has Been Approved!');
});

it('includes both whatsapp group links in the approved email in every locale', function (string $locale, string $expectedIntro): void {
    App::setLocale($locale);

    $registration = Registration::factory()->create([
        'type' => 'ministry',
        'first_name' => 'Jane',
        'status' => 'approved',
        'locale' => $locale,
    ]);

    $mailable = new MinistryApplicationApproved($registration);

    $mailable->assertSeeInHtml('https://chat.whatsapp.com/IHKiCvnyy5Q3fpPytkYBe8?mode=gi_t', false);
    $mailable->assertSeeInHtml('https://chat.whatsapp.com/HWsGWl1C6oY98CNsh21B73?mode=gi_t', false);
    $mailable->assertSeeInHtml($expectedIntro, false);
})->with([
    'english' => ['en', 'Please join the following WhatsApp groups'],
    'hungarian' => ['hu', 'Kérlek, csatlakozz az alábbi WhatsApp-csoportokhoz'],
]);
