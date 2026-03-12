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
        $ticketDuration = $data['ticket_duration'] ?? 'early_bird';
        $priceOption = $data['ticket_price_option'] ?? '20';
        $customAmount = (int) ($data['ticket_custom_amount'] ?? 0);

        $amountEuros = match ($priceOption) {
            '40' => 40,
            'custom' => $customAmount,
            default => 20,
        };

        $durationLabel = match ($ticketDuration) {
            'regular' => '3 Day Pass',
            default => '1 Day Pass',
        };
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
            <dd class="text-primary-400">{{ Number::currency($amountEuros, 'EUR') }}</dd>
        </div>
    @endif
</dl>
