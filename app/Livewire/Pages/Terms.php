<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Terms of Service - Europe Revival 2026')]
class Terms extends Component
{
    public function render(): View
    {
        return view('livewire.pages.terms');
    }
}
