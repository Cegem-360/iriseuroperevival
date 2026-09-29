<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\TicketPriceFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use Override;

#[Fillable([
    'uuid',
    'ticket_type',
    'pricing_tier',
    'price',
    'label',
    'description',
    'is_active',
    'sort_order',
])]
class TicketPrice extends Model
{
    /** @use HasFactory<TicketPriceFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    #[Override]
    protected static function booted(): void
    {
        static::creating(function (TicketPrice $ticketPrice): void {
            $ticketPrice->uuid = $ticketPrice->uuid ?? (string) Str::uuid();
        });
    }

    protected function priceInHuf(): Attribute
    {
        return Attribute::make(get: fn (): int|float => $this->price / 100);
    }

    protected function formattedPrice(): Attribute
    {
        return Attribute::make(get: fn (): string => Number::currency($this->price / 100, 'HUF', app()->getLocale(), precision: 0));
    }

    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('is_active', true);
    }

    #[Scope]
    protected function forTier(Builder $query, string $tier): void
    {
        $query->where('pricing_tier', $tier);
    }

    #[Scope]
    protected function forType(Builder $query, string $type): void
    {
        $query->where('ticket_type', $type);
    }

    #[Scope]
    protected function ordered(Builder $query): void
    {
        $query->orderBy('sort_order');
    }
}
