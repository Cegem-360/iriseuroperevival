<?php

declare(strict_types=1);

namespace App\Livewire\Shop;

use App\Models\PromotionCode;
use App\Services\CartService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class ShoppingCart extends Component
{
    public string $promoCode = '';

    public string $promoError = '';

    public string $promoSuccess = '';

    protected CartService $cartService;

    public function boot(CartService $cartService): void
    {
        $this->cartService = $cartService;
    }

    public function updateQuantity(int $productId, int $quantity): void
    {
        $this->cartService->update($productId, $quantity);
    }

    public function removeItem(int $productId): void
    {
        $this->cartService->remove($productId);
    }

    public function applyPromoCode(): void
    {
        $this->promoError = '';
        $this->promoSuccess = '';

        if (empty($this->promoCode)) {
            $this->promoError = 'Please enter a promotion code.';

            return;
        }

        if ($this->cartService->applyPromotionCode($this->promoCode)) {
            $this->promoSuccess = 'Promotion code applied successfully!';
            $this->promoCode = '';
        } else {
            $this->promoError = 'Invalid or expired promotion code.';
        }
    }

    public function removePromoCode(): void
    {
        $this->cartService->removePromotionCode();
        $this->promoSuccess = '';
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

    #[Computed]
    public function isEmpty(): bool
    {
        return $this->cartService->isEmpty();
    }

    #[On('cart-updated')]
    public function refreshCart(): void
    {
        // Computed properties will automatically refresh
    }

    public function render(): Factory|View
    {
        return view('livewire.shop.shopping-cart');
    }
}
