<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Models\Donation;
use App\Services\StripeService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Number;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Donate - Europe Revival 2026')]
class Donate extends Component
{
    public ?int $selectedAmount = 10000;

    public bool $isCustom = false;

    public ?string $customAmount = null;

    public function selectAmount(int $amount): void
    {
        if (! in_array($amount, Donation::PRESET_AMOUNTS_HUF, true)) {
            return;
        }

        $this->selectedAmount = $amount;
        $this->isCustom = false;
        $this->resetValidation();
    }

    public function chooseCustom(): void
    {
        $this->isCustom = true;
        $this->selectedAmount = null;
    }

    public function donate(): mixed
    {
        if ($this->isCustom) {
            $minimum = __('Minimum :amount', ['amount' => Number::currency(Donation::MIN_AMOUNT_HUF, 'HUF', app()->getLocale(), precision: 0)]);

            $this->validate([
                'customAmount' => ['required', 'integer', 'min:' . Donation::MIN_AMOUNT_HUF, 'max:' . Donation::MAX_AMOUNT_HUF],
            ], [
                'customAmount.required' => __('Please choose an amount.'),
                'customAmount.integer' => __('Please choose an amount.'),
                'customAmount.min' => $minimum,
                'customAmount.max' => __('Maximum :amount', ['amount' => Number::currency(Donation::MAX_AMOUNT_HUF, 'HUF', app()->getLocale(), precision: 0)]),
            ]);
        }

        $amount = $this->isCustom ? (int) $this->customAmount : (int) $this->selectedAmount;

        if (! $this->isCustom && ! in_array($amount, Donation::PRESET_AMOUNTS_HUF, true)) {
            $this->addError('customAmount', __('Please choose an amount.'));

            return null;
        }

        $donation = Donation::query()->create([
            'amount_huf' => $amount,
            'locale' => app()->getLocale(),
        ]);

        try {
            return redirect()->away(resolve(StripeService::class)->createDonationCheckoutSession($donation));
        } catch (Exception $exception) {
            report($exception);
            $this->addError('customAmount', __('An error occurred. Please try again or contact support.'));

            return null;
        }
    }

    public function render(): View
    {
        return view('livewire.pages.donate');
    }
}
