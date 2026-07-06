@php
    $livewire = $getLivewire();
    $data = $livewire->data ?? [];
    $type = $data['registration_type'] ?? 'attendee';
    $firstName = $data['first_name'] ?? '';
    $lastName = $data['last_name'] ?? '';
    $email = $data['email'] ?? '';
    $phone = $data['phone'] ?? '';
    $city = $data['city'] ?? '';
    $country = $data['country'] ?? '';

    if ($type === 'attendee') {
        $summary = $livewire->ticketSummary();
        $amountHuf = $summary['amount_huf'];
        $durationLabel = \App\Models\Registration::formatTicketType($summary['duration']);

        $dayLabels = [
            'friday' => __('Friday'),
            'saturday' => __('Saturday'),
            'sunday' => __('Sunday'),
        ];
    }
@endphp

<dl class="space-y-3">
    <div class="flex justify-between">
        <dt class="text-white/60">{{ __('Name') }}</dt>
        <dd class="text-white font-medium">{{ $firstName }} {{ $lastName }}</dd>
    </div>
    <div class="flex justify-between">
        <dt class="text-white/60">{{ __('Email') }}</dt>
        <dd class="text-white font-medium">{{ $email }}</dd>
    </div>
    @if($phone)
        <div class="flex justify-between">
            <dt class="text-white/60">{{ __('Phone') }}</dt>
            <dd class="text-white font-medium">{{ $phone }}</dd>
        </div>
    @endif
    <div class="flex justify-between">
        <dt class="text-white/60">{{ __('Location') }}</dt>
        <dd class="text-white font-medium">{{ $city }}, {{ $country }}</dd>
    </div>
    @if($type === 'attendee')
        <div class="border-t border-navy-600 pt-3 flex justify-between">
            <dt class="text-white/60">{{ __('Pass') }}</dt>
            <dd class="text-white font-medium">
                @if($summary['is_group'])
                    {{ __('Group Ticket') }} — {{ $durationLabel }}
                    @if($summary['day'])
                        ({{ $dayLabels[$summary['day']] ?? '' }})
                    @endif
                @else
                    {{ $durationLabel }}
                @endif
            </dd>
        </div>
        @if($summary['is_group'])
            <div class="flex justify-between">
                <dt class="text-white/60">{{ __('Number of People') }}</dt>
                <dd class="text-white font-medium">{{ $summary['size'] }} × {{ Number::currency($summary['rate'], 'HUF', app()->getLocale(), precision: 0) }}</dd>
            </div>
        @endif
        <div class="flex justify-between">
            <dt class="text-white/60">{{ __('Street Evangelism') }}</dt>
            <dd class="text-white font-medium">{{ ($data['wants_to_evangelize'] ?? false) ? __('Yes') : __('No') }}</dd>
        </div>
        <div class="flex justify-between text-lg font-bold">
            <dt class="text-primary-400">{{ __('Total') }}</dt>
            <dd class="text-primary-400">{{ Number::currency($amountHuf, 'HUF', app()->getLocale(), precision: 0) }}</dd>
        </div>
    @endif
</dl>
