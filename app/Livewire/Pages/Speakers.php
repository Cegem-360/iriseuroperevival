<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Models\Speaker;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Speakers - Europe Revival 2026')]
class Speakers extends Component
{
    public function render(): View
    {
        $featuredSpeakers = Speaker::query()
            ->featured()
            ->whereNotNull('photo_path')
            ->ordered()
            ->get();

        $workshopLeaders = Speaker::query()
            ->ofType('workshop_leader')
            ->whereNotNull('photo_path')
            ->ordered()
            ->get();

        $worshipLeaders = Speaker::query()
            ->ofType('worship_leader')
            ->whereNotNull('photo_path')
            ->ordered()
            ->get();

        return view('livewire.pages.speakers', [
            'featuredSpeakers' => $featuredSpeakers,
            'workshopLeaders' => $workshopLeaders,
            'worshipLeaders' => $worshipLeaders,
        ]);
    }
}
