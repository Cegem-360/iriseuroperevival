<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\WorkshopFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Override;

class Workshop extends Model
{
    /** @use HasFactory<WorkshopFactory> */
    use HasFactory;

    protected $fillable = [
        'uuid',
        'slug',
        'title',
        'short_description',
        'description',
        'benefits',
        'speaker_id',
        'image_path',
        'capacity',
        'duration_minutes',
        'difficulty_level',
        'requirements',
        'is_published',
        'sort_order',
        'translations',
    ];

    protected function casts(): array
    {
        return [
            'benefits' => 'array',
            'requirements' => 'array',
            'is_published' => 'boolean',
            'translations' => 'array',
        ];
    }

    #[Override]
    protected static function booted(): void
    {
        static::creating(function (Workshop $workshop): void {
            $workshop->uuid = $workshop->uuid ?? (string) Str::uuid();
            $workshop->slug = $workshop->slug ?? Str::slug($workshop->title);
        });
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

    protected function formattedDuration(): Attribute
    {
        return Attribute::make(get: function (): string {
            if (! $this->duration_minutes) {
                return '';
            }

            $hours = intdiv($this->duration_minutes, 60);
            $minutes = $this->duration_minutes % 60;

            if ($hours > 0 && $minutes > 0) {
                return "{$hours}h {$minutes}m";
            } elseif ($hours > 0) {
                return "{$hours}h";
            }

            return "{$minutes}m";
        });
    }

    #[Scope]
    protected function published($query)
    {
        return $query->where('is_published', true);
    }

    #[Scope]
    protected function ordered($query)
    {
        return $query->orderBy('sort_order');
    }

    #[Scope]
    protected function ofDifficulty($query, string $level)
    {
        return $query->where('difficulty_level', $level);
    }
}
