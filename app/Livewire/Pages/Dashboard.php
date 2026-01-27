<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Models\Registration;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Dashboard - Europe Revival 2026')]
class Dashboard extends Component
{
    public function render(): View
    {
        $registrations = Registration::forUser(auth()->user())
            ->latest()
            ->get();

        return view('livewire.pages.dashboard', ['registrations' => $registrations]);
    }
}
