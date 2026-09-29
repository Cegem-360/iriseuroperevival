<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\SponsorFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'logo_path',
    'website_url',
    'tier',
    'sort_order',
    'is_active',
])]
class Sponsor extends Model
{
    /** @use HasFactory<SponsorFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('is_active', true);
    }

    #[Scope]
    protected function ofTier(Builder $query, string $tier): void
    {
        $query->where('tier', $tier);
    }

    #[Scope]
    protected function ordered(Builder $query): void
    {
        $query->orderBy('sort_order');
    }

    #[Scope]
    protected function byTierPriority(Builder $query): void
    {
        $query->orderByRaw('CASE tier
            WHEN \'platinum\' THEN 1
            WHEN \'gold\' THEN 2
            WHEN \'silver\' THEN 3
            WHEN \'bronze\' THEN 4
            ELSE 5 END');
    }
}
