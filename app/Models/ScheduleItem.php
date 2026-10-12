<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Database\Factories\ScheduleItemFactory;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'title',
    'description',
    'day',
    'start_time',
    'end_time',
    'type',
    'speaker_id',
    'location',
    'translations',
    'is_published',
    'sort_order',
])]
class ScheduleItem extends Model
{
    /** @use HasFactory<ScheduleItemFactory> */
    use HasFactory, HasTranslations;

    protected function casts(): array
    {
        return [
            'day' => 'date',
            'start_time' => 'datetime:H:i',
            'end_time' => 'datetime:H:i',
            'translations' => 'array',
            'is_published' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<Speaker, $this>
     */
    public function speaker(): BelongsTo
    {
        return $this->belongsTo(Speaker::class);
    }

    /**
     * @param  Builder<static>  $query
     */
    #[Scope]
    protected function ofType(Builder $query, string $type): void
    {
        $query->where('type', $type);
    }

    /**
     * @param  Builder<static>  $query
     */
    #[Scope]
    protected function onDay(Builder $query, DateTimeInterface|string $day): void
    {
        $query->whereDate('day', $day);
    }

    /**
     * @param  Builder<static>  $query
     */
    #[Scope]
    protected function ordered(Builder $query): void
    {
        // sort_order dominates so admin (or a seeder) can override the natural
        // time-based order for a specific block. start_time is the fallback
        // for items that share a sort_order.
        $query->orderBy('day')->orderBy('sort_order')->orderBy('start_time');
    }

    /**
     * @param  Builder<static>  $query
     */
    #[Scope]
    protected function published(Builder $query): void
    {
        $query->where('is_published', true);
    }
}
