<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

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
        $workshopLeaders = collect();

        return view('livewire.pages.workshops', ['workshopLeaders' => $workshopLeaders]);
    }
}
