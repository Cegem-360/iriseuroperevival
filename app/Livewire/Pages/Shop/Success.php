<?php

declare(strict_types=1);

namespace App\Livewire\Pages\Shop;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Order Confirmed - Europe Revival 2026')]
class Success extends Component
{
    public Order $order;

    public function mount(string $uuid): void
    {
        $this->order = Order::query()->where('uuid', $uuid)->firstOrFail();
    }

    public function render(): View
    {
        return view('livewire.pages.shop.success');
    }
}
