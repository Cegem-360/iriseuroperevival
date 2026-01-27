<?php

namespace App\Models;

use Override;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    /** @use HasFactory<OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'uuid',
        'email',
        'customer_name',
        'phone',
        'billing_address',
        'shipping_address',
        'status',
        'subtotal',
        'discount',
        'total',
        'promotion_code_id',
        'stripe_session_id',
        'stripe_payment_intent',
        'paid_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'integer',
            'discount' => 'integer',
            'total' => 'integer',
            'paid_at' => 'datetime',
        ];
    }

    #[Override]
    protected static function booted(): void
    {
        static::creating(function (Order $order): void {
            $order->uuid = $order->uuid ?? (string) Str::uuid();
        });
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function promotionCode(): BelongsTo
    {
        return $this->belongsTo(PromotionCode::class);
    }

    protected function totalInEuros(): Attribute
    {
        return Attribute::make(get: fn(): int|float => $this->total / 100);
    }

    protected function formattedTotal(): Attribute
    {
        return Attribute::make(get: fn(): string => number_format($this->total_in_euros, 2).' €');
    }

    protected function subtotalInEuros(): Attribute
    {
        return Attribute::make(get: fn(): int|float => $this->subtotal / 100);
    }

    protected function discountInEuros(): Attribute
    {
        return Attribute::make(get: fn(): int|float => $this->discount / 100);
    }

    public function isPaid(): bool
    {
        return $this->paid_at !== null;
    }

    public function markAsPaid(): void
    {
        $this->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);
    }

    public function calculateTotals(): void
    {
        $this->subtotal = $this->items->sum('total');
        $this->discount = $this->calculateDiscount();
        $this->total = $this->subtotal - $this->discount;
    }

    protected function calculateDiscount(): int
    {
        if (! $this->promotionCode) {
            return 0;
        }

        return $this->promotionCode->calculateDiscount($this->subtotal);
    }

    #[Scope]
    protected function ofStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    #[Scope]
    protected function paid($query)
    {
        return $query->whereNotNull('paid_at');
    }

    #[Scope]
    protected function pending($query)
    {
        return $query->where('status', 'pending');
    }
}
