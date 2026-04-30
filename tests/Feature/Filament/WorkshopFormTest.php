<?php

declare(strict_types=1);

use App\Filament\Resources\Workshops\Pages\EditWorkshop;
use App\Models\User;
use App\Models\Workshop;
use Livewire\Livewire;

test('admin can save translations for a workshop', function (): void {
    $admin = User::factory()->create(['is_admin' => true]);
    $workshop = Workshop::factory()->create([
        'title' => 'Original Title',
        'short_description' => 'Original short',
        'description' => 'Original long description',
        'date' => '2026-10-23',
    ]);

    $this->actingAs($admin);

    Livewire::test(EditWorkshop::class, ['record' => $workshop->getRouteKey()])
        ->fillForm([
            'translations.hu.title' => 'Magyar cím',
            'translations.hu.short_description' => 'Magyar rövid leírás',
            'translations.hu.description' => 'Magyar részletes leírás',
            'translations.en.title' => 'English Title',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $workshop->refresh();

    expect($workshop->translations)
        ->toMatchArray([
            'hu' => [
                'title' => 'Magyar cím',
                'short_description' => 'Magyar rövid leírás',
                'description' => 'Magyar részletes leírás',
            ],
            'en' => [
                'title' => 'English Title',
                'short_description' => null,
                'description' => null,
            ],
        ]);

    expect($workshop->t('title', 'hu'))->toBe('Magyar cím');
    expect($workshop->t('title', 'en'))->toBe('English Title');
    expect($workshop->t('short_description', 'en'))->toBe('Original short');
});
