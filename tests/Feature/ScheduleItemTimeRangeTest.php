<?php

declare(strict_types=1);

use App\Models\ScheduleItem;
use Tests\TestCase;

it('shows a time range for regular schedule items', function (): void {
    $item = ScheduleItem::factory()->make(['start_time' => '15:00', 'end_time' => '16:30']);

    expect($item->timeRange())->toBe('15:00 - 16:30')
        ->and($item->timeRange('–'))->toBe('15:00–16:30');
});

it('shows a single time when start and end are equal, as for doors open', function (): void {
    $item = ScheduleItem::factory()->make(['title' => 'Doors open', 'start_time' => '08:00', 'end_time' => '08:00']);

    expect($item->timeRange())->toBe('08:00');
});

it('renders the doors-open item on the program page with a single time', function (): void {
    /** @var TestCase $this */
    ScheduleItem::factory()->create([
        'title' => 'Doors open',
        'day' => '2026-10-24',
        'start_time' => '08:00',
        'end_time' => '08:00',
        'sort_order' => 0,
        'is_published' => true,
    ]);

    $this->get(route('program'))
        ->assertOk()
        ->assertSee('Doors open')
        ->assertDontSee('08:00 - 08:00');
});
