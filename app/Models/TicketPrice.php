<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\TicketPriceFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use Override;

class TicketPrice extends Model
{
    /** @use HasFactory<TicketPriceFactory> */
    use HasFactory;

    protected $fillable = [
        'uuid',
        'ticket_type',
        'pricing_tier',
        'price',
        'label',
        'description',
        'is_active',
        'sort_order',
    ];

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
    protected function active($query)
    {
        return $query->where('is_active', true);
    }

    #[Scope]
    protected function forTier($query, string $tier)
    {
        return $query->where('pricing_tier', $tier);
    }

    #[Scope]
    protected function forType($query, string $type)
    {
        return $query->where('ticket_type', $type);
    }

    #[Scope]
    protected function ordered($query)
    {
        return $query->orderBy('sort_order');
    }
}
