<div>
<div class="min-h-screen bg-(--alt-navy-deeper) flex items-center justify-center px-4 py-28">
    <div class="max-w-lg w-full text-center">
        <div class="mb-8">
            <div class="w-24 h-24 mx-auto bg-linear-to-br from-(--alt-gold) to-(--alt-gold-light) rounded-full flex items-center justify-center shadow-lg">
                <svg class="w-12 h-12 text-(--alt-navy-deeper)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </div>
        </div>

        <h1 class="font-heading text-3xl md:text-4xl font-bold uppercase tracking-wide text-(--alt-beige) mb-4">{{ __('Thank you for your donation!') }}</h1>

        @if ($donation->is_paid)
            <p class="text-(--alt-beige-muted) text-lg mb-2">{{ __('Your donation of :amount has been received.', ['amount' => $donation->formatted_amount]) }}</p>
        @else
            <p class="text-(--alt-beige-muted) text-lg mb-2">{{ __('Your payment of :amount is being processed.', ['amount' => $donation->formatted_amount]) }}</p>
        @endif
        <p class="text-(--alt-beige) text-lg mb-10">{{ __('Every gift counts – thank you for building this mission together with us!') }}</p>

        <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-linear-to-r from-(--alt-gold) to-(--alt-gold-light) text-(--alt-navy-deeper) font-heading font-bold uppercase tracking-wider rounded-full transition-all duration-300 hover:scale-[1.02]">
            {{ __('Back to Home') }}
        </a>
    </div>
</div>
</div>
