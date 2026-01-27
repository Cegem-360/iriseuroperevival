<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Register extends Component
{
    public string $type = 'attendee';

    public string $title = 'Register for Europe Revival 2026';

    public string $subtitle = 'Secure your spot at the conference';

    public function mount(string $type = 'attendee'): void
    {
        $this->type = $type;

        $this->title = match ($type) {
            'ministry' => 'Ministry Team Application',
            'volunteer' => 'Volunteer Application',
            default => 'Register for Europe Revival 2026',
        };

        $this->subtitle = match ($type) {
            'ministry' => 'Apply to serve at Europe Revival 2026',
            'volunteer' => 'Join us as a volunteer at Europe Revival 2026',
            default => 'Secure your spot at the conference',
        };
    }

    public function render(): View
    {
        return view('livewire.pages.register')
            ->title($this->title.' - Europe Revival 2026');
    }
}
