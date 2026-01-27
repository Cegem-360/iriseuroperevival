<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use App\Models\PromotionCode;
use Illuminate\Support\Collection;

class CartService
{
    protected const SESSION_KEY = 'shopping_cart';

    protected const PROMO_KEY = 'cart_promotion_code';

    public function getItems(): Collection
    {
        $items = session(self::SESSION_KEY, []);

        return collect($items)->map(function (array $item): ?array {
            $product = Product::query()->find($item['product_id']);

            if (! $product) {
                return null;
            }

            return [
                'product' => $product,
                'quantity' => $item['quantity'],
                'total' => $product->price * $item['quantity'],
            ];
        })->filter();
    }

    public function add(Product $product, int $quantity = 1): void
    {
        $items = session(self::SESSION_KEY, []);
        $productId = $product->id;

        if (isset($items[$productId])) {
            $items[$productId]['quantity'] += $quantity;
        } else {
            $items[$productId] = [
                'product_id' => $productId,
                'quantity' => $quantity,
            ];
        }

        session([self::SESSION_KEY => $items]);
    }

    public function update(int $productId, int $quantity): void
    {
        $items = session(self::SESSION_KEY, []);

        if ($quantity <= 0) {
            unset($items[$productId]);
        } else {
            $items[$productId]['quantity'] = $quantity;
        }

        session([self::SESSION_KEY => $items]);
    }

    public function remove(int $productId): void
    {
        $items = session(self::SESSION_KEY, []);
        unset($items[$productId]);
        session([self::SESSION_KEY => $items]);
    }

    public function clear(): void
    {
        session()->forget(self::SESSION_KEY);
        session()->forget(self::PROMO_KEY);
    }

    public function count(): int
    {
        return $this->getItems()->sum('quantity');
    }

    public function subtotal(): int
    {
        return $this->getItems()->sum('total');
    }

    public function discount(): int
    {
        $promoCode = $this->getPromotionCode();

        if (! $promoCode instanceof PromotionCode) {
            return 0;
        }

        return $promoCode->calculateDiscount($this->subtotal());
    }

    public function total(): int
    {
        return max(0, $this->subtotal() - $this->discount());
    }

    public function applyPromotionCode(string $code): bool
    {
        $promoCode = PromotionCode::query()->where('code', $code)->first();

        if (! $promoCode || ! $promoCode->isValid($this->subtotal())) {
            return false;
        }

        session([self::PROMO_KEY => $promoCode->id]);

        return true;
    }

    public function removePromotionCode(): void
    {
        session()->forget(self::PROMO_KEY);
    }

    public function getPromotionCode(): ?PromotionCode
    {
        $promoCodeId = session(self::PROMO_KEY);

        if (! $promoCodeId) {
            return null;
        }

        return PromotionCode::query()->find($promoCodeId);
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }
}
