<div>
    <flux:heading size="xl" class="mb-6">Checkout</flux:heading>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <form wire:submit="checkout" class="space-y-6">
                <div class="rounded-lg border border-zinc-200 p-6 dark:border-zinc-700">
                    <flux:heading size="lg" class="mb-4">Contact Information</flux:heading>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <flux:field class="md:col-span-2">
                            <flux:label for="customerName">Full Name</flux:label>
                            <flux:input wire:model="customerName" id="customerName" required />
                            <flux:error name="customerName" />
                        </flux:field>

                        <flux:field>
                            <flux:label for="email">Email</flux:label>
                            <flux:input wire:model="email" type="email" id="email" required />
                            <flux:error name="email" />
                        </flux:field>

                        <flux:field>
                            <flux:label for="phone">Phone (optional)</flux:label>
                            <flux:input wire:model="phone" type="tel" id="phone" />
                            <flux:error name="phone" />
                        </flux:field>
                    </div>
                </div>

                <div class="rounded-lg border border-zinc-200 p-6 dark:border-zinc-700">
                    <flux:heading size="lg" class="mb-4">Billing Address</flux:heading>

                    <flux:field>
                        <flux:label for="billingAddress">Address</flux:label>
                        <flux:textarea wire:model="billingAddress" id="billingAddress" rows="3" required />
                        <flux:error name="billingAddress" />
                    </flux:field>
                </div>

                <div class="rounded-lg border border-zinc-200 p-6 dark:border-zinc-700">
                    <div class="mb-4 flex items-center justify-between">
                        <flux:heading size="lg">Shipping Address</flux:heading>
                        <flux:checkbox wire:model.live="sameAsShipping" label="Same as billing" />
                    </div>

                    @if(!$sameAsShipping)
                        <flux:field>
                            <flux:label for="shippingAddress">Address</flux:label>
                            <flux:textarea wire:model="shippingAddress" id="shippingAddress" rows="3" />
                            <flux:error name="shippingAddress" />
                        </flux:field>
                    @else
                        <flux:text class="text-zinc-500">Shipping address will be the same as billing address.</flux:text>
                    @endif
                </div>

                <div class="flex items-center justify-between">
                    <flux:button href="{{ route('shop.cart') }}" variant="ghost">
                        &larr; Back to Cart
                    </flux:button>

                    <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Proceed to Payment</span>
                        <span wire:loading>Processing...</span>
                    </flux:button>
                </div>
            </form>
        </div>

        <div class="lg:col-span-1">
            <div class="sticky top-4 rounded-lg border border-zinc-200 bg-zinc-50 p-6 dark:border-zinc-700 dark:bg-zinc-800">
                <flux:heading size="lg" class="mb-4">Order Summary</flux:heading>

                <div class="space-y-3">
                    @foreach($this->items as $item)
                        <div class="flex justify-between text-sm">
                            <span>{{ $item['product']->name }} x {{ $item['quantity'] }}</span>
                            <span>{{ Number::currency($item['total'] / 100, 'EUR') }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 space-y-2 border-t border-zinc-200 pt-4 dark:border-zinc-700">
                    <div class="flex justify-between">
                        <span class="text-zinc-600 dark:text-zinc-400">Subtotal</span>
                        <span>{{ Number::currency($this->subtotal / 100, 'EUR') }}</span>
                    </div>

                    @if($this->discount > 0)
                        <div class="flex justify-between text-green-600">
                            <span>Discount</span>
                            <span>-{{ Number::currency($this->discount / 100, 'EUR') }}</span>
                        </div>
                    @endif

                    <div class="flex justify-between border-t border-zinc-200 pt-2 text-lg font-bold dark:border-zinc-700">
                        <span>Total</span>
                        <span>{{ Number::currency($this->total / 100, 'EUR') }}</span>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-center gap-2 text-sm text-zinc-500">
                    <flux:icon name="lock-closed" class="h-4 w-4" />
                    <span>Secure checkout powered by Stripe</span>
                </div>
            </div>
        </div>
    </div>
</div>
