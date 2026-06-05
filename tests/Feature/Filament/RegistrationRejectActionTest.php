<?php

declare(strict_types=1);

use App\Filament\Resources\Registrations\Pages\ListRegistrations;
use App\Mail\VolunteerApplicationRejected;
use App\Models\Registration;
use App\Models\User;
use Filament\Actions\Testing\TestAction;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;

beforeEach(function (): void {
    $this->actingAs(User::factory()->admin()->create());
});

it('pre-fills the reject reason with the bilingual default letter', function (): void {
    $registration = Registration::factory()->create([
        'type' => 'volunteer',
        'first_name' => 'Anna',
        'status' => 'pending_approval',
    ]);

    Livewire::test(ListRegistrations::class)
        ->mountAction(TestAction::make('reject')->table($registration))
        ->assertSchemaStateSet([
            'reason' => str_replace(':name', 'Anna', config('rejection.default')),
        ]);
});

it('rejects a volunteer and queues the rejection email', function (): void {
    Mail::fake();

    $registration = Registration::factory()->create([
        'type' => 'volunteer',
        'status' => 'pending_approval',
    ]);

    Livewire::test(ListRegistrations::class)
        ->callAction(TestAction::make('reject')->table($registration), data: [
            'reason' => 'Custom reason',
        ])
        ->assertNotified();

    expect($registration->refresh())
        ->status->toBe('rejected')
        ->rejection_reason->toBe('Custom reason');

    Mail::assertQueued(VolunteerApplicationRejected::class, fn ($mail): bool => $mail->hasTo($registration->email));
});
