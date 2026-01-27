<?php

declare(strict_types=1);

namespace App\Livewire\Pages\Shop;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Shopping Cart - Europe Revival 2026')]
class Cart extends Component
{
    public function render(): View
    {
        return view('livewire.pages.shop.cart');
    }
}
