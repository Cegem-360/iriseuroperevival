<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Database\Factories\SpeakerFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Str;
use Override;

class Speaker extends Model
{
    /** @use HasFactory<SpeakerFactory> */
    use HasFactory, HasTranslations;

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

    /**
     * Resolve the speaker photo to a public URL, supporting both
     * Vite-bundled assets (legacy seed paths) and Filament uploads.
     */
    protected function photoUrl(): Attribute
    {
        return Attribute::make(get: function (): ?string {
            $path = $this->photo_path;

            if (! $path) {
                return null;
            }

            if (str_starts_with($path, 'images/')) {
                return Vite::asset('resources/' . $path);
            }

            return Storage::disk('public')->url($path);
        });
    }

    public function scheduleItems(): HasMany
    {
        return $this->hasMany(ScheduleItem::class);
    }

    public function workshops(): HasMany
    {
        return $this->hasMany(Workshop::class);
    }

    #[Scope]
    protected function featured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    #[Scope]
    protected function ofType(Builder $query, string $type): void
    {
        $query->where('type', $type);
    }

    #[Scope]
    protected function ordered(Builder $query): void
    {
        $query->orderBy('sort_order');
    }
}
