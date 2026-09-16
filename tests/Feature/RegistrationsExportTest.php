<?php

declare(strict_types=1);

use App\Exports\RegistrationsExport;
use App\Models\Registration;
use Illuminate\Support\Facades\Schema;

it('exports every column of the registrations table', function (): void {
    $export = new RegistrationsExport();

    $registration = Registration::factory()->create();

    expect($export->headings())->toHaveCount(count(Schema::getColumnListing('registrations')));

    $row = $export->map($registration);

    expect($row)->toHaveCount(count($export->headings()));
});

it('formats enum, array, boolean, date and amount columns', function (): void {
    $registration = Registration::factory()->create([
        'country' => 'Hungary',
        'languages' => ['English', 'Hungarian'],
        'is_born_again' => true,
        'attended_ministry_school' => false,
        'amount' => 25000,
        'paid_at' => now(),
        'admin_notes' => null,
    ]);

    $export = new RegistrationsExport();
    $row = array_combine($export->headings(), $export->map($registration));

    expect($row['Country'])->toBe('Hungary')
        ->and($row['Languages'])->toBe('English, Hungarian')
        ->and($row['Born Again'])->toBe('Yes')
        ->and($row['Attended Ministry School'])->toBe('No')
        ->and($row['Amount (EUR)'])->toBe('250.00')
        ->and($row['Paid At'])->toBe($registration->paid_at->format('Y-m-d H:i'))
        ->and($row['Admin Notes'])->toBe('');
});

it('includes previously missing columns such as testimony and admin notes', function (): void {
    $registration = Registration::factory()->create([
        'testimony' => 'My testimony',
        'admin_notes' => 'Checked by admin',
        'occupation' => 'Teacher',
        'invited_by' => 'Someone',
    ]);

    $export = new RegistrationsExport();
    $row = array_combine($export->headings(), $export->map($registration));

    expect($row['Testimony'])->toBe('My testimony')
        ->and($row['Admin Notes'])->toBe('Checked by admin')
        ->and($row['Occupation'])->toBe('Teacher')
        ->and($row['Invited By'])->toBe('Someone');
});
