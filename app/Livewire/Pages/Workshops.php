<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Models\Workshop;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Workshops - Europe Revival 2026')]
class Workshops extends Component
{
    public function render(): View
    {
        $allWorkshops = Workshop::query()
            ->published()
            ->ordered()
            ->with('speaker')
            ->get();

        // Group by speaker + title to show one card per unique workshop,
        // combining schedule notes when same workshop runs on both days
        $workshops = $allWorkshops->groupBy(fn ($w) => $w->speaker_id . '-' . $w->title)->map(function ($group) {
            $primary = $group->first();
            $notes = $group->pluck('schedule_note')->filter()->unique()->sort();
            $primary->schedule_note = $notes->count() > 1
                ? 'Saturday & Sunday'
                : $notes->first();

            return $primary;
        })->values();

        return view('livewire.pages.workshops', [
            'workshops' => $workshops,
        ]);
    }
}
