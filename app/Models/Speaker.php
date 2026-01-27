<?php

namespace App\Models;

use Database\Factories\SpeakerFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Override;

class Speaker extends Model
{
    /** @use HasFactory<SpeakerFactory> */
    use HasFactory;

    protected $fillable = [
        'uuid',
        'slug',
        'name',
        'title',
        'organization',
        'country',
        'bio',
        'photo_path',
        'type',
        'is_featured',
        'sort_order',
        'social_links',
        'translations',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'social_links' => 'array',
            'translations' => 'array',
        ];
    }

    #[Override]
    protected static function booted(): void
    {
        static::creating(function (Speaker $speaker): void {
            $speaker->uuid = $speaker->uuid ?? (string) Str::uuid();
            $speaker->slug = $speaker->slug ?? Str::slug($speaker->name);
        });
    }

    public function scheduleItems(): HasMany
    {
        return $this->hasMany(ScheduleItem::class);
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
    protected function featured($query)
    {
        return $query->where('is_featured', true);
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
