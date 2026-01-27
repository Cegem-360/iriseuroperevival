<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\FaqFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    /** @use HasFactory<FaqFactory> */
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'category',
        'sort_order',
        'is_published',
        'translations',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'translations' => 'array',
        ];
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
    protected function published($query)
    {
        return $query->where('is_published', true);
    }

    #[Scope]
    protected function ofCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    #[Scope]
    protected function ordered($query)
    {
        return $query->orderBy('sort_order');
    }
}
