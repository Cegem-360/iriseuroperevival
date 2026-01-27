<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Models\Registration;
use App\Services\StripeService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Registration Successful - Europe Revival 2026')]
class RegisterSuccess extends Component
{
    public Registration $registration;

    public function mount(string $uuid): void
    {
        $this->registration = Registration::query()->where('uuid', $uuid)->firstOrFail();

        // If coming from Stripe, verify the payment
        if (request()->has('session_id')) {
            $stripeService = app(StripeService::class);
            $session = $stripeService->retrieveSession(request()->session_id);

            if ($session->payment_status === 'paid' && ! $this->registration->is_paid) {
                $this->registration->markAsPaid($session->payment_intent);
                $this->registration->refresh();
            }
        }
    }

    public function render(): View
    {
        return view('livewire.pages.register-success');
    }
}
