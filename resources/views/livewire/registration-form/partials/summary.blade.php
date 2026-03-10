@php
    use App\Services\StripeService;

    $livewire = $getLivewire();
    $data = $livewire->data ?? [];
    $type = $data['registration_type'] ?? 'attendee';
    $firstName = $data['first_name'] ?? '';
    $lastName = $data['last_name'] ?? '';
    $email = $data['email'] ?? '';
    $phone = $data['phone'] ?? '';
    $city = $data['city'] ?? '';
    $country = $data['country'] ?? '';
    $ticketType = $data['ticket_type'] ?? 'individual';
    $ticketQuantity = (int) ($data['ticket_quantity'] ?? 1);

    $stripeService = app(StripeService::class);
    $tier = $stripeService->getCurrentPricingTier();
    $pricePerTicketCents = $stripeService->getTicketPrice($ticketType, $tier);
    $totalCents = $pricePerTicketCents * $ticketQuantity;
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
        @php
            $ticketLabel = match ($ticketType) {
                'individual' => 'Standard Ticket',
                'team' => 'Group Pass',
                'vip' => 'VIP Pass',
                default => 'Ticket',
            };
        @endphp
        <div class="border-t border-navy-600 pt-3 flex justify-between">
            <dt class="text-white/60">Tickets</dt>
            <dd class="text-white font-medium">{{ $ticketQuantity }}x {{ $ticketLabel }}</dd>
        </div>
        <div class="flex justify-between text-sm">
            <dt class="text-white/60">Price per ticket</dt>
            <dd class="text-white font-medium">€{{ number_format($pricePerTicketCents / 100, 2) }}</dd>
        </div>
        <div class="flex justify-between text-lg font-bold">
            <dt class="text-primary-400">Total</dt>
            <dd class="text-primary-400">€{{ number_format($totalCents / 100, 2) }}</dd>
        </div>
    @endif
</dl>
