@php
    $stripeService = app(\App\Services\StripeService::class);
    $tier = $stripeService->getCurrentPricingTier();
    $volunteerPrice = $stripeService->getVolunteerPrice() / 100;
    $regularPrice = $stripeService->getTicketPrice('individual', $tier) / 100;
    $savings = $regularPrice - $volunteerPrice;

    $tierLabels = [
        'early' => 'Early Bird',
        'regular' => 'Regular',
        'late' => 'Late',
    ];
@endphp

<div class="space-y-4">
    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-500/10 to-cyan-500/10 border border-blue-500/30 rounded-xl">
        <div>
            <p class="text-white font-semibold">Volunteer Pass</p>
            <p class="text-white/60 text-sm">{{ $tierLabels[$tier] ?? 'Current' }} Pricing</p>
        </div>
        <div class="text-right">
            <p class="text-2xl font-bold text-blue-400">€{{ number_format($volunteerPrice, 2) }}</p>
            <p class="text-white/40 text-sm line-through">€{{ number_format($regularPrice, 2) }}</p>
        </div>
    </div>

    <div class="flex items-center gap-2 text-green-400 text-sm">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span>You save €{{ number_format($savings, 2) }} as a volunteer!</span>
    </div>

    <div class="text-white/50 text-xs">
        <p>{{ __('Includes:') }}</p>
        <ul class="list-disc list-inside mt-1 space-y-1">
            <li>{{ __('Full conference access during breaks') }}</li>
            <li>{{ __('Meals during volunteer shifts') }}</li>
            <li>{{ __('Volunteer t-shirt') }}</li>
            <li>{{ __('Certificate of service') }}</li>
        </ul>
    </div>
</div>
