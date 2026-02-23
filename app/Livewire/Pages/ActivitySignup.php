<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Sign Up for Activities - Europe Revival 2026')]
class ActivitySignup extends Component
{
    public string $activity = 'workshop';

    public function mount(string $activity = 'workshop'): void
    {
        $this->activity = $activity;
    }

    public function getActivityTitle(): string
    {
        return match ($this->activity) {
            'healing_room' => 'Healing Rooms',
            'prophetic_room' => 'Prophetic Rooms',
            'street_evangelism' => 'Street Evangelism',
            default => 'Workshops',
        };
    }

    public function getActivityDescription(): string
    {
        return match ($this->activity) {
            'healing_room' => 'Sign up for a personal session in our healing rooms. Experience prayer and ministry from trained team members.',
            'prophetic_room' => 'Sign up for a session in our prophetic rooms. Receive personal prophetic words and encouragement.',
            'street_evangelism' => 'Join our street evangelism teams going out into the city of Budapest. Share the love of Jesus with those around you.',
            default => 'Reserve your spot at one of our inspiring workshops. Led by experienced speakers and ministry leaders.',
        };
    }

    public function render(): View
    {
        return view('livewire.pages.activity-signup');
    }
}
