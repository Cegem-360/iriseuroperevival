<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Database\Factories\FaqFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'question',
    'answer',
    'category',
    'sort_order',
    'is_published',
    'translations',
])]
class Faq extends Model
{
    /** @use HasFactory<FaqFactory> */
    use HasFactory, HasTranslations;

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'translations' => 'array',
        ];
    }

    #[Scope]
    protected function published(Builder $query): void
    {
        $query->where('is_published', true);
    }

    #[Scope]
    protected function ofCategory(Builder $query, string $category): void
    {
        $query->where('category', $category);
    }

    #[Scope]
    protected function ordered(Builder $query): void
    {
        $query->orderBy('sort_order');
    }
}
