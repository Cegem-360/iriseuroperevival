<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Override;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'description',
        'price',
        'type',
        'stock_quantity',
        'is_active',
        'image_path',
        'attributes',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'stock_quantity' => 'integer',
            'is_active' => 'boolean',
            'attributes' => 'array',
        ];
    }

    #[Override]
    protected static function booted(): void
    {
        static::creating(function (Product $product): void {
            $product->uuid = $product->uuid ?? (string) Str::uuid();
            $product->slug = $product->slug ?? Str::slug($product->name);
        });
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    protected function priceInEuros(): Attribute
    {
        return Attribute::make(get: fn (): int|float => $this->price / 100);
    }

    protected function formattedPrice(): Attribute
    {
        return Attribute::make(get: fn (): string => number_format($this->price_in_euros, 2) . ' €');
    }

    public function isInStock(): bool
    {
        if ($this->stock_quantity === null) {
            return true; // Unlimited stock
        }

        return $this->stock_quantity > 0;
    }

    public function decrementStock(int $quantity = 1): void
    {
        if ($this->stock_quantity !== null) {
            $this->decrement('stock_quantity', $quantity);
        }
    }

    #[Scope]
    protected function active($query)
    {
        return $query->where('is_active', true);
    }

    #[Scope]
    protected function inStock($query)
    {
        return $query->where(function ($q): void {
            $q->whereNull('stock_quantity')
                ->orWhere('stock_quantity', '>', 0);
        });
    }

    #[Scope]
    protected function ofType($query, string $type)
    {
        return $query->where('type', $type);
    }

    #[Scope]
    protected function ordered($query)
    {
        return $query->orderBy('sort_order');
    }
}
