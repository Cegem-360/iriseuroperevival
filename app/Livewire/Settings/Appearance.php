<?php

declare(strict_types=1);

namespace App\Livewire\Settings;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.auth.simple')]
#[Title('Appearance Settings - Europe Revival 2026')]
class Appearance extends Component
{
    public function render(): View
    {
        return view('livewire.settings.appearance');
    }
}
