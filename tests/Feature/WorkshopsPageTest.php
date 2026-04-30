<?php

declare(strict_types=1);

use App\Livewire\Pages\Workshops;
use App\Models\Speaker;
use App\Models\Workshop;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

describe('workshops page', function () {
    it('renders workshops page successfully', function () {
        $this->get('/workshops')
            ->assertStatus(200)
            ->assertSeeLivewire(Workshops::class);
    });

    it('shows empty state when no workshops', function () {
        Livewire::test(Workshops::class)
            ->assertSee('Workshop Details Coming Soon');
    });

    it('renders speaker photo from a Filament-uploaded path', function () {
        $speaker = Speaker::factory()->create([
            'name' => 'Uploaded Speaker',
            'photo_path' => 'speakers/01KQEQW52YBDBKSVPGG0QMSAMJ.jpg',
        ]);

        Workshop::factory()->create([
            'title' => 'Workshop With Uploaded Speaker',
            'speaker_id' => $speaker->id,
            'leader_name' => $speaker->name,
            'is_published' => true,
        ]);

        Livewire::test(Workshops::class)
            ->assertSee('Workshop With Uploaded Speaker')
            ->assertSee('/storage/speakers/01KQEQW52YBDBKSVPGG0QMSAMJ.jpg');
    });

    it('displays workshops', function () {
        Workshop::factory()->create([
            'title' => 'Prophetic Arts Workshop',
            'short_description' => 'Learn to express worship through art.',
        ]);

        Livewire::test(Workshops::class)
            ->assertSee('Prophetic Arts Workshop')
            ->assertSee('Learn to express worship through art.');
    });

    it('displays workshop duration', function () {
        Workshop::factory()->create([
            'title' => 'Two Hour Workshop',
            'duration_minutes' => 120,
        ]);

        Livewire::test(Workshops::class)
            ->assertSee('Two Hour Workshop')
            ->assertSee('2h');
    });

    it('displays workshop leader name', function () {
        Workshop::factory()->create([
            'title' => 'Art Workshop',
            'leader_name' => 'Dr. Kate',
        ]);

        Livewire::test(Workshops::class)
            ->assertSee('Art Workshop')
            ->assertSee('Dr. Kate');
    });

    it('displays workshop leader with speaker link', function () {
        $speaker = Speaker::factory()->create([
            'name' => 'Workshop Leader',
            'slug' => 'workshop-leader',
        ]);

        Workshop::factory()->create([
            'title' => 'Art Workshop',
            'leader_name' => 'Workshop Leader',
            'speaker_id' => $speaker->id,
        ]);

        Livewire::test(Workshops::class)
            ->assertSee('Art Workshop')
            ->assertSee('Workshop Leader');
    });

    it('displays schedule note badge', function () {
        Workshop::factory()->create([
            'title' => 'Saturday Workshop',
            'schedule_note' => 'Saturday only',
        ]);

        Livewire::test(Workshops::class)
            ->assertSee('Saturday Workshop')
            ->assertSee('Saturday only');
    });

    it('hides unpublished workshops', function () {
        Workshop::factory()->create([
            'title' => 'Published Workshop',
            'is_published' => true,
        ]);

        Workshop::factory()->unpublished()->create([
            'title' => 'Draft Workshop',
        ]);

        Livewire::test(Workshops::class)
            ->assertSee('Published Workshop')
            ->assertDontSee('Draft Workshop');
    });

    it('orders workshops by sort_order', function () {
        Workshop::factory()->create([
            'title' => 'Second Workshop',
            'sort_order' => 2,
        ]);

        Workshop::factory()->create([
            'title' => 'First Workshop',
            'sort_order' => 1,
        ]);

        $component = Livewire::test(Workshops::class);

        $html = $component->html();
        $firstPosition = strpos($html, 'First Workshop');
        $secondPosition = strpos($html, 'Second Workshop');

        expect($firstPosition)->toBeLessThan($secondPosition);
    });

    it('shows registration call to action when workshops exist', function () {
        Workshop::factory()->create(['title' => 'Any Workshop']);

        Livewire::test(Workshops::class)
            ->assertSee('Ready to join?')
            ->assertSee('Register Now');
    });
});
