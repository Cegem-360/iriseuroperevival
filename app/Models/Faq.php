<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Database\Factories\FaqFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    /** @use HasFactory<FaqFactory> */
    use HasFactory, HasTranslations;

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
