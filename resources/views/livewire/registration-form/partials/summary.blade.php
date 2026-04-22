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
        $ticketDuration = $data['ticket_duration'] ?? '1_day';
        $priceOption = $data['ticket_price_option'] ?? '7500';
        $customAmount = (int) ($data['ticket_custom_amount'] ?? 0);

        $minCustom = $ticketDuration === '3_days' ? 15000 : 7500;

        $amountHuf = match ($priceOption) {
            '15000' => 15000,
            'custom' => $customAmount > $minCustom ? $customAmount : 0,
            default => 7500,
        };

        $durationLabel = \App\Models\Registration::formatTicketType($ticketDuration);
    }
@endphp

<dl class="space-y-3">
    <div class="flex justify-between">
        <dt class="text-white/60">Name</dt>
        <dd class="text-white font-medium">{{ $firstName }} {{ $lastName }}</dd>
    </div>
    <div class="flex justify-between">
        <dt class="text-white/60">Email</dt>
        <dd class="text-white font-medium">{{ $email }}</dd>
    </div>
    @if($phone)
        <div class="flex justify-between">
            <dt class="text-white/60">Phone</dt>
            <dd class="text-white font-medium">{{ $phone }}</dd>
        </div>
    @endif
    <div class="flex justify-between">
        <dt class="text-white/60">Location</dt>
        <dd class="text-white font-medium">{{ $city }}, {{ $country }}</dd>
    </div>
    @if($type === 'attendee')
        <div class="border-t border-navy-600 pt-3 flex justify-between">
            <dt class="text-white/60">Pass</dt>
            <dd class="text-white font-medium">{{ $durationLabel }}</dd>
        </div>
        <div class="flex justify-between text-lg font-bold">
            <dt class="text-primary-400">Total</dt>
            <dd class="text-primary-400">{{ Number::currency($amountHuf, 'HUF', app()->getLocale(), precision: 0) }}</dd>
        </div>
    @endif
</dl>
