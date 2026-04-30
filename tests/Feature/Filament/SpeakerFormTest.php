<?php

declare(strict_types=1);

use App\Filament\Resources\Speakers\Pages\EditSpeaker;
use App\Models\Speaker;
use App\Models\User;
use Livewire\Livewire;

test('admin can save translations for a speaker', function (): void {
    $admin = User::factory()->create(['is_admin' => true]);
    $speaker = Speaker::factory()->create([
        'title' => 'Original Title',
        'organization' => 'Original Org',
        'bio' => 'Original bio',
    ]);

    $this->actingAs($admin);

    Livewire::test(EditSpeaker::class, ['record' => $speaker->getRouteKey()])
        ->fillForm([
            'translations.hu.title' => 'Magyar titulus',
            'translations.hu.organization' => 'Magyar szervezet',
            'translations.hu.bio' => 'Magyar bemutatkozás',
            'translations.en.title' => 'English Title',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $speaker->refresh();

    expect($speaker->translations)
        ->toMatchArray([
            'hu' => [
                'title' => 'Magyar titulus',
                'organization' => 'Magyar szervezet',
                'bio' => 'Magyar bemutatkozás',
            ],
            'en' => [
                'title' => 'English Title',
                'organization' => null,
                'bio' => null,
            ],
        ]);

    expect($speaker->t('title', 'hu'))->toBe('Magyar titulus');
    expect($speaker->t('title', 'en'))->toBe('English Title');
    expect($speaker->t('bio', 'en'))->toBe('Original bio');
});
