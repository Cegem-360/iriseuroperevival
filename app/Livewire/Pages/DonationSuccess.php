<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Models\Donation;
use App\Services\StripeService;
use Exception;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Thank You - Europe Revival 2026')]
class DonationSuccess extends Component
{
    public Donation $donation;

    public function mount(Donation $donation): void
    {
        $this->donation = $donation;
        $sessionId = request()->query('session_id');

        if (! $donation->is_paid && is_string($sessionId) && $sessionId === $donation->stripe_session_id) {
            try {
                $stripeService = resolve(StripeService::class);
                $stripeService->completeDonation($donation, $stripeService->retrieveSession($sessionId));
                $this->donation->refresh();
            } catch (Exception $exception) {
                report($exception);
            }
        }
    }

    public function render(): View
    {
        return view('livewire.pages.donation-success');
    }
}
