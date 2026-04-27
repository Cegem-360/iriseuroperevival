<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Models\Speaker;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class SpeakerShow extends Component
{
    public Speaker $speaker;

    public function mount(string $slug): void
    {
        $this->speaker = Speaker::query()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function render(): View
    {
        $otherSpeakers = Speaker::query()
            ->where('id', '!=', $this->speaker->id)
            ->whereNotNull('photo_path')
            ->where(fn ($q) => $q
                ->whereHas('workshops')
                ->orWhereHas('scheduleItems'))
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('livewire.pages.speaker-show', [
            'speaker' => $this->speaker,
            'otherSpeakers' => $otherSpeakers,
        ])
            ->title($this->speaker->name . ' - Europe Revival 2026');
    }
}
