<?php

declare(strict_types=1);

use App\Livewire\Pages\Program;
use App\Models\ScheduleItem;
use App\Models\Speaker;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

describe('program page', function () {
    it('renders program page successfully', function () {
        $this->get('/program')
            ->assertStatus(200)
            ->assertSeeLivewire(Program::class);
    });

    it('shows empty state when no schedule items', function () {
        Livewire::test(Program::class)
            ->assertSee('Full Schedule Coming Soon');
    });

    it('displays schedule items grouped by day', function () {
        ScheduleItem::factory()->create([
            'title' => 'Morning Worship',
            'day' => '2026-08-06',
            'start_time' => '09:00',
            'end_time' => '10:00',
            'type' => 'worship',
        ]);

        ScheduleItem::factory()->create([
            'title' => 'Afternoon Session',
            'day' => '2026-08-06',
            'start_time' => '14:00',
            'end_time' => '15:30',
            'type' => 'session',
        ]);

        Livewire::test(Program::class)
            ->assertSee('Morning Worship')
            ->assertSee('Afternoon Session')
            ->assertSee('09:00')
            ->assertSee('14:00');
    });

    it('displays different schedule types with badges', function () {
        ScheduleItem::factory()->worship()->create(['title' => 'Worship Time']);
        ScheduleItem::factory()->session()->create(['title' => 'Teaching Session']);
        ScheduleItem::factory()->meal()->create(['title' => 'Lunch Break']);

        Livewire::test(Program::class)
            ->assertSee('Worship Time')
            ->assertSee('Teaching Session')
            ->assertSee('Lunch Break');
    });

    it('displays speaker information when attached', function () {
        $speaker = Speaker::factory()->create(['name' => 'John Smith']);

        ScheduleItem::factory()->withSpeaker($speaker)->create([
            'title' => 'Main Session',
        ]);

        Livewire::test(Program::class)
            ->assertSee('Main Session')
            ->assertSee('John Smith');
    });

    it('displays location when available', function () {
        ScheduleItem::factory()->create([
            'title' => 'Session in Chapel',
            'location' => 'Main Chapel',
        ]);

        Livewire::test(Program::class)
            ->assertSee('Session in Chapel')
            ->assertSee('Main Chapel');
    });

    it('hides unpublished schedule items', function () {
        ScheduleItem::factory()->create([
            'title' => 'Published Session',
            'is_published' => true,
        ]);

        ScheduleItem::factory()->unpublished()->create([
            'title' => 'Draft Session',
        ]);

        Livewire::test(Program::class)
            ->assertSee('Published Session')
            ->assertDontSee('Draft Session');
    });

    it('can switch between days', function () {
        ScheduleItem::factory()->create([
            'title' => 'Day 1 Session',
            'day' => '2026-08-06',
        ]);

        ScheduleItem::factory()->create([
            'title' => 'Day 2 Session',
            'day' => '2026-08-07',
        ]);

        Livewire::test(Program::class)
            ->assertSee('Day 1 Session')
            ->call('setActiveDay', '2026-08-07')
            ->assertSet('activeDay', '2026-08-07');
    });

    it('orders schedule items by time', function () {
        ScheduleItem::factory()->create([
            'title' => 'Second Session',
            'day' => '2026-08-06',
            'start_time' => '14:00',
            'end_time' => '15:00',
        ]);

        ScheduleItem::factory()->create([
            'title' => 'First Session',
            'day' => '2026-08-06',
            'start_time' => '09:00',
            'end_time' => '10:00',
        ]);

        $component = Livewire::test(Program::class);

        $html = $component->html();
        $firstPosition = strpos($html, 'First Session');
        $secondPosition = strpos($html, 'Second Session');

        expect($firstPosition)->toBeLessThan($secondPosition);
    });
});
