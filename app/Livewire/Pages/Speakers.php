<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

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
        $mainSpeakers = collect();
        $workshopLeaders = collect();

        return view('livewire.pages.speakers', ['mainSpeakers' => $mainSpeakers, 'workshopLeaders' => $workshopLeaders]);
    }
}
