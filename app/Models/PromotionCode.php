<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\PromotionCodeFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PromotionCode extends Model
{
    /** @use HasFactory<PromotionCodeFactory> */
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'max_uses',
        'used_count',
        'min_order_amount',
        'valid_from',
        'valid_until',
        'is_active',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'integer',
            'max_uses' => 'integer',
            'used_count' => 'integer',
            'min_order_amount' => 'integer',
            'valid_from' => 'datetime',
            'valid_until' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function isValid(?int $orderAmount = null): bool
    {
        if (! $this->is_active) {
            return false;
        }

        if ($this->valid_from && now()->lt($this->valid_from)) {
            return false;
        }

        if ($this->valid_until && now()->gt($this->valid_until)) {
            return false;
        }

        if ($this->max_uses !== null && $this->used_count >= $this->max_uses) {
            return false;
        }

        if ($orderAmount !== null && $this->min_order_amount !== null && $orderAmount < $this->min_order_amount) {
            return false;
        }

        return true;
    }

    public function calculateDiscount(int $subtotal): int
    {
        if (! $this->isValid($subtotal)) {
            return 0;
        }

        if ($this->type === 'percentage') {
            return (int) round($subtotal * ($this->value / 100));
        }

        // Fixed amount discount
        return min($this->value, $subtotal);
    }

    public function incrementUsage(): void
    {
        $this->increment('used_count');
    }

    protected function formattedValue(): Attribute
    {
        return Attribute::make(get: function (): string {
            if ($this->type === 'percentage') {
                return $this->value . '%';
            }

            return number_format($this->value / 100, 2) . ' €';
        });
    }

    #[Scope]
    protected function active($query)
    {
        return $query->where('is_active', true);
    }

    #[Scope]
    protected function valid($query)
    {
        return $query->active()
            ->where(function ($q): void {
                $q->whereNull('valid_from')
                    ->orWhere('valid_from', '<=', now());
            })
            ->where(function ($q): void {
                $q->whereNull('valid_until')
                    ->orWhere('valid_until', '>=', now());
            })
            ->where(function ($q): void {
                $q->whereNull('max_uses')
                    ->orWhereColumn('used_count', '<', 'max_uses');
            });
    }
}
