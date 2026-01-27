<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Europe Revival 2026 - Encounter Jesus. Catch on Fire.')]
class Home extends Component
{
    public function render(): View
    {
        // TODO: Add Speaker, Sponsor, Faq models when ready
        $speakers = collect();
        $sponsors = collect();
        $faqs = collect();

        return view('livewire.pages.home', ['speakers' => $speakers, 'sponsors' => $sponsors, 'faqs' => $faqs]);
    }
}
