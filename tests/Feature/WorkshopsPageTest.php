<?php

declare(strict_types=1);

use App\Livewire\Pages\Workshops;
use App\Models\Speaker;
use App\Models\Workshop;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

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

    it('displays workshops', function () {
        Workshop::factory()->create([
            'title' => 'Prophetic Arts Workshop',
            'short_description' => 'Learn to express worship through art.',
        ]);

        Livewire::test(Workshops::class)
            ->assertSee('Prophetic Arts Workshop')
            ->assertSee('Learn to express worship through art.');
    });

    it('displays workshop difficulty level', function () {
        Workshop::factory()->beginner()->create(['title' => 'Beginner Workshop']);
        Workshop::factory()->intermediate()->create(['title' => 'Intermediate Workshop']);
        Workshop::factory()->advanced()->create(['title' => 'Advanced Workshop']);

        Livewire::test(Workshops::class)
            ->assertSee('Beginner Workshop')
            ->assertSee('Intermediate Workshop')
            ->assertSee('Advanced Workshop')
            ->assertSee('Beginner')
            ->assertSee('Intermediate')
            ->assertSee('Advanced');
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

    it('displays workshop capacity', function () {
        Workshop::factory()->create([
            'title' => 'Limited Workshop',
            'capacity' => 30,
        ]);

        Livewire::test(Workshops::class)
            ->assertSee('Limited Workshop')
            ->assertSee('30');
    });

    it('displays workshop leader information', function () {
        $speaker = Speaker::factory()->create([
            'name' => 'Workshop Leader',
            'title' => 'Artist',
        ]);

        Workshop::factory()->create([
            'title' => 'Art Workshop',
            'speaker_id' => $speaker->id,
        ]);

        Livewire::test(Workshops::class)
            ->assertSee('Art Workshop')
            ->assertSee('Workshop Leader')
            ->assertSee('Artist');
    });

    it('displays workshop benefits', function () {
        Workshop::factory()->create([
            'title' => 'Prayer Workshop',
            'benefits' => [
                'Learn effective prayer techniques',
                'Build a prayer habit',
            ],
        ]);

        Livewire::test(Workshops::class)
            ->assertSee('Prayer Workshop')
            ->assertSee('Learn effective prayer techniques')
            ->assertSee('Build a prayer habit');
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
