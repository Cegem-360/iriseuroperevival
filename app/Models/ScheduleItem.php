<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Database\Factories\ScheduleItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduleItem extends Model
{
    /** @use HasFactory<ScheduleItemFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'day',
        'start_time',
        'end_time',
        'type',
        'speaker_id',
        'location',
        'translations',
    ];

    protected function casts(): array
    {
        return [
            'day' => 'date',
            'start_time' => 'datetime:H:i',
            'end_time' => 'datetime:H:i',
            'translations' => 'array',
        ];
    }

    public function speaker(): BelongsTo
    {
        return $this->belongsTo(Speaker::class);
    }

    protected function translated(): Attribute
    {
        return Attribute::make(get: function (string $attribute, ?string $locale = null) {
            $locale = $locale ?? app()->getLocale();
            $translations = $this->translations ?? [];
            return $translations[$locale][$attribute] ?? $this->$attribute;
        });
    }

    #[Scope]
    protected function ofType($query, string $type)
    {
        return $query->where('type', $type);
    }

    #[Scope]
    protected function onDay($query, $day)
    {
        return $query->whereDate('day', $day);
    }

    #[Scope]
    protected function ordered($query)
    {
        return $query->orderBy('day')->orderBy('start_time');
    }
}
