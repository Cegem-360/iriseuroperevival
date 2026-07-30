@php
    $livewire = $getLivewire();
    $summary = $livewire->ticketSummary();

    $durationLabel = \App\Models\Registration::formatTicketType($summary['duration']);
    $amountHuf = $summary['amount_huf'];

    $dayLabels = [
        'friday' => __('Friday'),
        'saturday' => __('Saturday'),
        'sunday' => __('Sunday'),
    ];
@endphp

<div class="space-y-4">
    <div class="space-y-2">
        @if($summary['is_group'])
            <div class="flex justify-between text-sm text-white/60">
                <span>
                    {{ __('Group Ticket') }} — {{ $durationLabel }}
                    @if($summary['day'])
                        ({{ $dayLabels[$summary['day']] ?? '' }})
                    @endif
                </span>
                <span>{{ Number::currency($summary['rate'], 'HUF', app()->getLocale(), precision: 0) }} / {{ __('person') }}</span>
            </div>
            <div class="flex justify-between text-sm text-white/60">
                <span>{{ __('Number of People') }}</span>
                <span>{{ $summary['size'] }} × {{ Number::currency($summary['rate'], 'HUF', app()->getLocale(), precision: 0) }}</span>
            </div>
        @else
            <div class="flex justify-between text-sm text-white/60">
                <span>
                    {{ $durationLabel }}
                    @if($summary['day'])
                        ({{ $dayLabels[$summary['day']] ?? '' }})
                    @endif
                </span>
                @if($summary['rate'] > 0 && $summary['size'] > 1)
                    <span>{{ Number::currency($summary['rate'], 'HUF', app()->getLocale(), precision: 0) }} / {{ __('ticket') }}</span>
                @elseif($amountHuf > 0)
                    <span>{{ Number::currency($amountHuf, 'HUF', app()->getLocale(), precision: 0) }}</span>
                @else
                    <span class="text-white/30">—</span>
                @endif
            </div>
            @if($summary['size'] > 1)
                <div class="flex justify-between text-sm text-white/60">
                    <span>{{ __('Number of Tickets') }}</span>
                    <span>
                        @if($summary['rate'] > 0)
                            {{ $summary['size'] }} × {{ Number::currency($summary['rate'], 'HUF', app()->getLocale(), precision: 0) }}
                        @else
                            {{ $summary['size'] }}
                        @endif
                    </span>
                </div>
            @endif
        @endif
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
