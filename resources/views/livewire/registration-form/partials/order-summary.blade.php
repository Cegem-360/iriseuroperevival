@php
    $livewire = $getLivewire();
    $data = $livewire->data ?? [];
    $ticketDuration = $data['ticket_duration'] ?? '1_day';
    $priceOption = $data['ticket_price_option'] ?? '20';
    $customAmount = (int) ($data['ticket_custom_amount'] ?? 0);

    $amountEuros = match ($priceOption) {
        '30' => 30,
        '40' => 40,
        '60' => 60,
        'custom' => $customAmount > ($ticketDuration === '3_days' ? 60 : 40) ? $customAmount : 0,
        default => 20,
    };

    $durationLabel = match ($ticketDuration) {
        '3_days' => '3 Day Supporter Pass',
        default => '1 Day Supporter Pass',
    };
@endphp

<div class="space-y-4">
    <div class="space-y-2">
        <div class="flex justify-between text-sm text-white/60">
            <span>{{ $durationLabel }}</span>
            @if($amountEuros > 0)
                <span>{{ Number::currency($amountEuros, 'EUR') }}</span>
            @else
                <span class="text-white/30">—</span>
            @endif
        </div>
    </div>

    <div class="border-t border-navy-600 pt-3 flex justify-between text-lg font-bold">
        <span class="text-primary-400">{{ __('Total') }}</span>
        <span class="text-primary-400">
            @if($amountEuros > 0)
                {{ Number::currency($amountEuros, 'EUR') }}
            @else
                —
            @endif
        </span>
    </div>
</div>
