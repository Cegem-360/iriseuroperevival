<?php

namespace App\Models;

use Override;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Database\Factories\OrderItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    /** @use HasFactory<OrderItemFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'quantity',
        'unit_price',
        'total',
        'attributes',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'unit_price' => 'integer',
            'total' => 'integer',
            'attributes' => 'array',
        ];
    }

    #[Override]
    protected static function booted(): void
    {
        static::creating(function (OrderItem $item): void {
            $item->total = $item->unit_price * $item->quantity;
        });

        static::updating(function (OrderItem $item): void {
            $item->total = $item->unit_price * $item->quantity;
        });
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    protected function unitPriceInEuros(): Attribute
    {
        return Attribute::make(get: fn(): int|float => $this->unit_price / 100);
    }

    protected function totalInEuros(): Attribute
    {
        return Attribute::make(get: fn(): int|float => $this->total / 100);
    }
}
