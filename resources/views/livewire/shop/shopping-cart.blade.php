<div>
    <flux:heading size="xl" class="mb-6">Shopping Cart</flux:heading>

    @if($this->isEmpty)
        <div class="py-12 text-center">
            <flux:icon name="shopping-cart" class="mx-auto h-16 w-16 text-zinc-400" />
            <flux:heading size="lg" class="mt-4">Your cart is empty</flux:heading>
            <flux:text class="mt-2">Looks like you haven't added anything to your cart yet.</flux:text>
            <div class="mt-6">
                <flux:button href="{{ route('shop.index') }}" variant="primary">
                    Continue Shopping
                </flux:button>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <div class="overflow-hidden rounded-lg border border-zinc-200 dark:border-zinc-700">
                    <table class="w-full">
                        <thead class="bg-zinc-50 dark:bg-zinc-800">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-medium text-zinc-500">Product</th>
                                <th class="px-4 py-3 text-center text-sm font-medium text-zinc-500">Quantity</th>
                                <th class="px-4 py-3 text-right text-sm font-medium text-zinc-500">Total</th>
                                <th class="px-4 py-3 text-right text-sm font-medium text-zinc-500"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                            @foreach($this->items as $item)
                                <tr wire:key="cart-item-{{ $item['product']->id }}">
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-4">
                                            @if($item['product']->image_path)
                                                <img src="{{ Storage::url($item['product']->image_path) }}" alt="{{ $item['product']->name }}" class="h-16 w-16 rounded object-cover" />
                                            @else
                                                <div class="flex h-16 w-16 items-center justify-center rounded bg-zinc-100 dark:bg-zinc-700">
                                                    <flux:icon name="photo" class="h-8 w-8 text-zinc-400" />
                                                </div>
                                            @endif
                                            <div>
                                                <div class="font-medium">{{ $item['product']->name }}</div>
                                                <div class="text-sm text-zinc-500">{{ $item['product']->formatted_price }} each</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <flux:button wire:click="updateQuantity({{ $item['product']->id }}, {{ $item['quantity'] - 1 }})" size="sm" variant="ghost" :disabled="$item['quantity'] <= 1">
                                                -
                                            </flux:button>
                                            <span class="w-8 text-center">{{ $item['quantity'] }}</span>
                                            <flux:button wire:click="updateQuantity({{ $item['product']->id }}, {{ $item['quantity'] + 1 }})" size="sm" variant="ghost">
                                                +
                                            </flux:button>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-right font-medium">
                                        {{ Number::currency($item['total'] / 100, 'HUF', app()->getLocale(), precision: 0) }}
                                    </td>
                                    <td class="px-4 py-4 text-right">
                                        <flux:button wire:click="removeItem({{ $item['product']->id }})" size="sm" variant="ghost">
                                            <flux:icon name="trash" class="h-4 w-4 text-red-500" />
                                        </flux:button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <flux:button href="{{ route('shop.index') }}" variant="ghost">
                        &larr; Continue Shopping
                    </flux:button>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="rounded-lg border border-zinc-200 bg-zinc-50 p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <flux:heading size="lg" class="mb-4">Order Summary</flux:heading>

                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-zinc-600 dark:text-zinc-400">Subtotal</span>
                            <span>{{ Number::currency($this->subtotal / 100, 'HUF', app()->getLocale(), precision: 0) }}</span>
                        </div>

                        @if($this->promotionCode)
                            <div class="flex items-center justify-between text-green-600">
                                <span>
                                    Discount ({{ $this->promotionCode->code }})
                                    <button wire:click="removePromoCode" class="ml-1 text-xs text-red-500 hover:underline">[remove]</button>
                                </span>
                                <span>-{{ Number::currency($this->discount / 100, 'HUF', app()->getLocale(), precision: 0) }}</span>
                            </div>
                        @endif

                        <div class="border-t border-zinc-200 pt-3 dark:border-zinc-700">
                            <div class="flex justify-between text-lg font-bold">
                                <span>Total</span>
                                <span>{{ Number::currency($this->total / 100, 'HUF', app()->getLocale(), precision: 0) }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Promo code field hidden for now
                    @if(!$this->promotionCode)
                        <div class="mt-4">
                            <flux:field>
                                <flux:label>Promotion Code</flux:label>
                                <div class="flex gap-2">
                                    <flux:input wire:model="promoCode" placeholder="Enter code" class="flex-1" />
                                    <flux:button wire:click="applyPromoCode" variant="ghost">Apply</flux:button>
                                </div>
                                @if($promoError)
                                    <flux:text class="mt-1 text-sm text-red-500">{{ $promoError }}</flux:text>
                                @endif
                                @if($promoSuccess)
                                    <flux:text class="mt-1 text-sm text-green-500">{{ $promoSuccess }}</flux:text>
                                @endif
                            </flux:field>
                        </div>
                    @endif
                    --}}

                    <div class="mt-6">
                        <flux:button href="{{ route('shop.checkout') }}" variant="primary" class="w-full">
                            Proceed to Checkout
                        </flux:button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
