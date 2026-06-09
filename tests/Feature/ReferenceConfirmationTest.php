<?php

declare(strict_types=1);

use App\Livewire\Pages\ReferenceConfirmation;
use App\Models\Registration;
use Illuminate\Support\Facades\URL;
use Livewire\Livewire;

use function Pest\Laravel\get;

function contactedMinistryRegistration(): Registration
{
    return Registration::factory()->ministry()->create([
        'reference_1_name' => 'Pastor Smith',
        'reference_1_email' => 'pastor@example.com',
        'reference_1_status' => 'contacted',
        'reference_2_name' => 'Elder Jones',
        'reference_2_email' => 'elder@example.com',
        'reference_2_status' => 'contacted',
    ]);
}

function signedReferenceUrl(Registration $registration, int $reference): string
{
    return URL::signedRoute('register.reference', [
        'registration' => $registration->uuid,
        'reference' => $reference,
    ]);
}

it('rejects an unsigned reference confirmation url', function (): void {
    $registration = contactedMinistryRegistration();

    $url = route('register.reference', [
        'registration' => $registration->uuid,
        'reference' => 1,
    ]);

    get($url)->assertForbidden();
});

it('rejects a tampered signature', function (): void {
    $registration = contactedMinistryRegistration();

    $url = signedReferenceUrl($registration, 1) . 'tampered';

    get($url)->assertForbidden();
});

it('allows a valid signed url for a contacted ministry reference', function (): void {
    $registration = contactedMinistryRegistration();

    get(signedReferenceUrl($registration, 1))->assertOk();
});

it('approves the applicant when the referee confirms', function (): void {
    $registration = contactedMinistryRegistration();

    Livewire::test(ReferenceConfirmation::class, ['registration' => $registration, 'reference' => 1])
        ->set('comment', 'I have known them for ten years.')
        ->call('submit', true)
        ->assertSet('submitted', true);

    $registration->refresh();

    expect($registration->reference_1_status)->toBe('approved')
        ->and($registration->reference_1_response)->toBe('I have known them for ten years.')
        ->and($registration->reference_1_responded_at)->not->toBeNull();
});

it('rejects the applicant when the referee declines', function (): void {
    $registration = contactedMinistryRegistration();

    Livewire::test(ReferenceConfirmation::class, ['registration' => $registration, 'reference' => 2])
        ->call('submit', false)
        ->assertSet('submitted', true);

    $registration->refresh();

    expect($registration->reference_2_status)->toBe('rejected')
        ->and($registration->reference_2_response)->toBeNull()
        ->and($registration->reference_2_responded_at)->not->toBeNull();
});

it('aborts for an invalid reference number', function (): void {
    $registration = contactedMinistryRegistration();

    Livewire::test(ReferenceConfirmation::class, ['registration' => $registration, 'reference' => 3])
        ->assertStatus(404);
});

it('aborts for a non-ministry registration', function (): void {
    $registration = Registration::factory()->attendee()->create([
        'reference_1_email' => 'pastor@example.com',
    ]);

    Livewire::test(ReferenceConfirmation::class, ['registration' => $registration, 'reference' => 1])
        ->assertStatus(404);
});

it('does not overwrite a reference that has already responded', function (): void {
    $registration = Registration::factory()->ministry()->create([
        'reference_1_name' => 'Pastor Smith',
        'reference_1_email' => 'pastor@example.com',
        'reference_1_status' => 'approved',
        'reference_1_response' => 'Original response',
        'reference_1_responded_at' => now(),
    ]);

    Livewire::test(ReferenceConfirmation::class, ['registration' => $registration, 'reference' => 1])
        ->set('comment', 'Trying to overwrite')
        ->call('submit', false);

    $registration->refresh();

    expect($registration->reference_1_status)->toBe('approved')
        ->and($registration->reference_1_response)->toBe('Original response');
});
