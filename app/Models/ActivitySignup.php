<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Override;

#[Fillable([
    'uuid',
    'activity_type',
    'workshop_id',
    'first_name',
    'last_name',
    'email',
    'phone',
    'notes',
])]
class ActivitySignup extends Model
{
    use HasFactory;

    #[Override]
    protected static function booted(): void
    {
        static::creating(function (self $signup): void {
            $signup->uuid = $signup->uuid ?? (string) Str::uuid();
        });
    }

    /**
     * @return BelongsTo<Workshop, $this>
     */
    public function workshop(): BelongsTo
    {
        return $this->belongsTo(Workshop::class);
    }

    /**
     * @param  Builder<static>  $query
     */
    #[Scope]
    protected function forActivity(Builder $query, string $type): void
    {
        $query->where('activity_type', $type);
    }
}
