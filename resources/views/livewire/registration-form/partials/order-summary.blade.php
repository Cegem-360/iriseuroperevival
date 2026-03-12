@php
    $livewire = $getLivewire();
    $data = $livewire->data ?? [];
    $ticketDuration = $data['ticket_duration'] ?? 'early_bird';
    $priceOption = $data['ticket_price_option'] ?? '20';
    $customAmount = (int) ($data['ticket_custom_amount'] ?? 0);

    $amountEuros = match ($priceOption) {
        '40' => 40,
        'custom' => $customAmount > 40 ? $customAmount : 0,
        default => 20,
    };

    $durationLabel = match ($ticketDuration) {
        'regular' => '3 Day Pass',
        default => '1 Day Pass',
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
        <span class="text-primary-400">Total</span>
        <span class="text-primary-400">
            @if($amountEuros > 0)
                {{ Number::currency($amountEuros, 'EUR') }}
            @else
                —
            @endif
        </span>
    </div>
</div>
