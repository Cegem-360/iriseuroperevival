<div class="min-h-screen bg-zinc-900 py-12">
    <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
        <div class="rounded-2xl border border-zinc-700 bg-zinc-800 p-8 text-center">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-500/20">
                <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h1 class="mt-6 text-3xl font-bold text-white">Order Confirmed!</h1>
            <p class="mt-2 text-lg text-zinc-400">Thank you for your purchase.</p>

            <div class="mt-8 rounded-lg bg-zinc-700/50 p-6 text-left">
                <h2 class="text-lg font-semibold text-white">Order Details</h2>

                <div class="mt-4 space-y-3">
                    <div class="flex justify-between">
                        <span class="text-zinc-400">Order ID</span>
                        <span class="font-mono text-sm text-white">{{ $order->uuid }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-400">Status</span>
                        <span class="rounded-full bg-green-500/20 px-3 py-1 text-sm text-green-400">{{ ucfirst($order->status) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-400">Total</span>
                        <span class="text-lg font-bold text-white">{{ $order->formatted_total }}</span>
                    </div>
                </div>

                @if($order->items->count() > 0)
                    <div class="mt-6 border-t border-zinc-600 pt-6">
                        <h3 class="text-sm font-medium text-zinc-400">Items</h3>
                        <ul class="mt-3 space-y-2">
                            @foreach($order->items as $item)
                                <li class="flex justify-between text-sm">
                                    <span class="text-white">{{ $item->product_name }} x {{ $item->quantity }}</span>
                                    <span class="text-zinc-400">{{ number_format($item->total / 100, 2) }} &euro;</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <p class="mt-6 text-zinc-400">
                A confirmation email has been sent to <strong class="text-white">{{ $order->email }}</strong>
            </p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center">
                <a href="{{ route('shop.index') }}" class="inline-flex items-center justify-center rounded-lg bg-amber-500 px-6 py-3 font-semibold text-black transition hover:bg-amber-400">
                    Continue Shopping
                </a>
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center rounded-lg border border-zinc-600 px-6 py-3 font-semibold text-white transition hover:border-zinc-500 hover:bg-zinc-700/50">
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</div>
