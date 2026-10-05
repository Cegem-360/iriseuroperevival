<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Register for Europe Revival 2026')]
#[Layout('components.layouts.app')]
class Register extends Component
{
    public string $type = 'attendee';

    public string $title = 'Register for Europe Revival 2026';

    public string $subtitle = 'Reserve your spot';

    public function mount(string $type = 'attendee'): void
    {
        $this->type = $type;

        if ($type === 'attendee') {
            $this->title = 'Now you get 2 tickets for the price of 1 supporter ticket';
            $this->subtitle = 'Invite your friend or acquaintance and experience together what God is preparing for you!';
        }
    }

    public function render(): View
    {
        return view(view: 'livewire.pages.register');
    }
}
