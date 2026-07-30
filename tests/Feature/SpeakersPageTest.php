<?php

declare(strict_types=1);

use App\Livewire\Pages\Speakers;
use App\Livewire\Pages\SpeakerShow;
use App\Models\Speaker;
use App\Models\Workshop;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    Speaker::query()->delete();
});

describe('speakers listing page', function () {
    it('is not publicly routable', function () {
        $this->get('/speakers')
            ->assertStatus(404);
    });

    it('displays featured speakers', function () {
        $speaker = Speaker::factory()->featured()->speaker()->create([
            'name' => 'Featured Speaker',
            'title' => 'Keynote',
            'organization' => 'Ministry Org',
            'country' => 'USA',
        ]);

        Livewire::test(Speakers::class)
            ->assertSee('Featured Speakers')
            ->assertSee('Featured Speaker')
            ->assertSee('Keynote')
            ->assertSee('Ministry Org');
    });

    it('displays workshop leaders', function () {
        $workshopLeader = Speaker::factory()->create([
            'name' => 'Workshop Person',
            'title' => 'Prophetic Arts',
            'type' => 'workshop_leader',
            'is_featured' => false,
        ]);

        Livewire::test(Speakers::class)
            ->assertSee('Workshop Leaders')
            ->assertSee('Workshop Person')
            ->assertSee('Prophetic Arts');
    });

    it('displays worship leaders', function () {
        $worshipLeader = Speaker::factory()->worshipLeader()->create([
            'name' => 'Worship Person',
            'title' => 'Worship Leader',
        ]);

        Livewire::test(Speakers::class)
            ->assertSee('Worship Leaders')
            ->assertSee('Worship Person');
    });

    it('shows empty state when no speakers', function () {
        Livewire::test(Speakers::class)
            ->assertSee('Speaker Announcements Coming Soon');
    });
});

describe('speaker detail page', function () {
    it('renders speaker detail page successfully', function () {
        $speaker = Speaker::factory()->create([
            'name' => 'Test Speaker',
            'slug' => 'test-speaker',
        ]);

        $this->get('/speakers/test-speaker')
            ->assertStatus(200)
            ->assertSeeLivewire(SpeakerShow::class);
    });

    it('displays speaker details', function () {
        $speaker = Speaker::factory()->create([
            'name' => 'John Doe',
            'slug' => 'john-doe',
            'title' => 'Senior Pastor',
            'organization' => 'Great Church',
            'country' => 'United Kingdom',
            'bio' => 'This is a bio about John Doe.',
        ]);

        Livewire::test(SpeakerShow::class, ['slug' => 'john-doe'])
            ->assertSee('John Doe')
            ->assertSee('Senior Pastor')
            ->assertSee('Great Church')
            ->assertSee('United Kingdom')
            ->assertSee('This is a bio about John Doe.');
    });

    it('displays social links when available', function () {
        $speaker = Speaker::factory()->create([
            'slug' => 'social-speaker',
            'social_links' => [
                'twitter' => 'https://twitter.com/test',
                'instagram' => 'https://instagram.com/test',
            ],
        ]);

        Livewire::test(SpeakerShow::class, ['slug' => 'social-speaker'])
            ->assertSee('Connect')
            ->assertSee('twitter')
            ->assertSee('instagram');
    });

    it('displays other speakers section', function () {
        $mainSpeaker = Speaker::factory()->create([
            'name' => 'Main Speaker',
            'slug' => 'main-speaker',
        ]);

        $otherSpeaker = Speaker::factory()->create([
            'name' => 'Other Speaker',
        ]);

        Workshop::factory()->create([
            'speaker_id' => $otherSpeaker->id,
        ]);

        Livewire::test(SpeakerShow::class, ['slug' => 'main-speaker'])
            ->assertSee('Other Speakers')
            ->assertSee('Other Speaker');
    });

    it('returns 404 for non-existent speaker', function () {
        $this->get('/speakers/non-existent-speaker')
            ->assertStatus(404);
    });
});
