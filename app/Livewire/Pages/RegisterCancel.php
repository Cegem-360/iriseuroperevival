<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Models\Registration;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Payment Cancelled - Europe Revival 2026')]
class RegisterCancel extends Component
{
    public Registration $registration;

    public function mount(string $uuid): void
    {
        $this->registration = Registration::query()->where('uuid', $uuid)->firstOrFail();
    }

    public function render(): View
    {
        return view('livewire.pages.register-cancel');
    }
}
