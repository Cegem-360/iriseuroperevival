@php
    $livewire = $getLivewire();
@endphp

<div class="space-y-3">
    <div class="flex justify-between text-sm text-white/60">
        <span>Europe Revival 2026 — Internal Test Pass</span>
        <span>{{ $livewire->getFormattedAmount() }}</span>
    </div>

    <div class="border-t border-navy-600 pt-3 flex justify-between text-lg font-bold">
        <span class="text-red-400">Total (live Stripe charge)</span>
        <span class="text-red-400">{{ $livewire->getFormattedAmount() }}</span>
    </div>
</div>
