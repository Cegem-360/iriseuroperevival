<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Models\ScheduleItem;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Program - Europe Revival 2026')]
class Program extends Component
{
    public string $activeDay = '';

    public function mount(): void
    {
        $firstDay = ScheduleItem::query()
            ->published()
            ->orderBy('day')
            ->value('day');

        $this->activeDay = $firstDay ? $firstDay->format('Y-m-d') : '';
    }

    public function setActiveDay(string $day): void
    {
        $this->activeDay = $day;
    }

    public function render(): View
    {
        $scheduleItems = ScheduleItem::query()
            ->published()
            ->ordered()
            ->with('speaker')
            ->get();

        $days = $scheduleItems->groupBy(fn ($item) => $item->day->format('Y-m-d'));

        return view('livewire.pages.program', [
            'scheduleItems' => $scheduleItems,
            'days' => $days,
        ]);
    }
}
