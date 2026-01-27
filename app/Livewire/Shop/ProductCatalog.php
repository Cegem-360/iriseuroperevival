<?php

namespace App\Livewire\Shop;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductCatalog extends Component
{
    public string $typeFilter = '';

    public string $search = '';

    public function addToCart(int $productId): void
    {
        $product = Product::query()->find($productId);

        if (! $product || ! $product->is_active || ! $product->isInStock()) {
            session()->flash('error', 'Product is not available.');

            return;
        }

        app(CartService::class)->add($product);

        $this->dispatch('cart-updated');
        session()->flash('success', 'Product added to cart!');
    }

    #[Computed]
    public function products()
    {
        return Product::query()
            ->active()
            ->inStock()
            ->when($this->typeFilter, fn ($q) => $q->ofType($this->typeFilter))
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->ordered()
            ->get();
    }

    #[Computed]
    public function cartCount(): int
    {
        return app(CartService::class)->count();
    }

    public function render(): Factory|View
    {
        return view('livewire.shop.product-catalog');
    }
}
