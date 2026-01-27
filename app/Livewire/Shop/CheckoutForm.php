<?php

declare(strict_types=1);

namespace App\Livewire\Shop;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PromotionCode;
use App\Services\CartService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

class CheckoutForm extends Component
{
    #[Validate('required|string|max:255')]
    public string $customerName = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('nullable|string|max:50')]
    public string $phone = '';

    #[Validate('required|string|max:500')]
    public string $billingAddress = '';

    #[Validate('nullable|string|max:500')]
    public string $shippingAddress = '';

    public bool $sameAsShipping = true;

    protected CartService $cartService;

    public function boot(CartService $cartService): void
    {
        $this->cartService = $cartService;
    }

    public function mount(): void
    {
        if ($this->cartService->isEmpty()) {
            $this->redirect(route('shop.cart'));
        }
    }

    public function updatedSameAsShipping(): void
    {
        if ($this->sameAsShipping) {
            $this->shippingAddress = '';
        }
    }

    #[Computed]
    public function items(): Collection
    {
        return $this->cartService->getItems();
    }

    #[Computed]
    public function subtotal(): int
    {
        return $this->cartService->subtotal();
    }

    #[Computed]
    public function discount(): int
    {
        return $this->cartService->discount();
    }

    #[Computed]
    public function total(): int
    {
        return $this->cartService->total();
    }

    #[Computed]
    public function promotionCode(): ?PromotionCode
    {
        return $this->cartService->getPromotionCode();
    }

    public function checkout(): void
    {
        $this->validate();

        if ($this->cartService->isEmpty()) {
            session()->flash('error', 'Your cart is empty.');
            $this->redirect(route('shop.cart'));

            return;
        }

        // Create the order
        $order = Order::query()->create([
            'customer_name' => $this->customerName,
            'email' => $this->email,
            'phone' => $this->phone,
            'billing_address' => $this->billingAddress,
            'shipping_address' => $this->sameAsShipping ? $this->billingAddress : $this->shippingAddress,
            'subtotal' => $this->subtotal,
            'discount' => $this->discount,
            'total' => $this->total,
            'promotion_code_id' => $this->promotionCode?->id,
            'status' => 'pending',
        ]);

        // Create order items
        foreach ($this->items as $item) {
            OrderItem::query()->create([
                'order_id' => $order->id,
                'product_id' => $item['product']->id,
                'product_name' => $item['product']->name,
                'quantity' => $item['quantity'],
                'unit_price' => $item['product']->price,
                'total' => $item['total'],
            ]);

            // Decrement stock
            $item['product']->decrementStock($item['quantity']);
        }

        // Create Stripe checkout session
        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = $this->items->map(fn ($item): array => [
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => $item['product']->name,
                    'description' => $item['product']->description ?? null,
                ],
                'unit_amount' => $item['product']->price,
            ],
            'quantity' => $item['quantity'],
        ])->toArray();

        // Add discount as a negative line item if applicable
        if ($this->discount > 0) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Discount (' . $this->promotionCode->code . ')',
                    ],
                    'unit_amount' => -$this->discount,
                ],
                'quantity' => 1,
            ];
        }

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('shop.success', ['uuid' => $order->uuid]) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('shop.checkout'),
            'customer_email' => $this->email,
            'metadata' => [
                'order_id' => $order->id,
                'order_uuid' => $order->uuid,
            ],
        ]);

        $order->update(['stripe_session_id' => $session->id]);

        // Clear cart
        $this->cartService->clear();

        // Increment promo code usage
        if ($this->promotionCode) {
            $this->promotionCode->incrementUsage();
        }

        $this->redirect($session->url);
    }

    public function render(): Factory|View
    {
        return view('livewire.shop.checkout-form');
    }
}
