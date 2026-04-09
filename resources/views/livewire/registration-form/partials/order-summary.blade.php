@php
    $livewire = $getLivewire();
    $data = $livewire->data ?? [];
    $ticketDuration = $data['ticket_duration'] ?? '1_day';
    $priceOption = $data['ticket_price_option'] ?? '7500';
    $customAmount = (int) ($data['ticket_custom_amount'] ?? 0);

    $amountHuf = match ($priceOption) {
        '15000' => 15000,
        'custom' => $customAmount > 15000 ? $customAmount : 0,
        default => 7500,
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
            @if($amountHuf > 0)
                <span>{{ Number::currency($amountHuf, 'HUF', app()->getLocale(), precision: 0) }}</span>
            @else
                <span class="text-white/30">—</span>
            @endif
        </div>
    </div>

    <div class="border-t border-navy-600 pt-3 flex justify-between text-lg font-bold">
        <span class="text-primary-400">{{ __('Total') }}</span>
        <span class="text-primary-400">
            @if($amountHuf > 0)
                {{ Number::currency($amountHuf, 'HUF', app()->getLocale(), precision: 0) }}
            @else
                —
            @endif
        </span>
    </div>
</div>
