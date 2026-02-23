<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Override;

class ActivitySignup extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'activity_type',
        'workshop_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'notes',
    ];

    #[Override]
    protected static function booted(): void
    {
        static::creating(function (self $signup): void {
            $signup->uuid = $signup->uuid ?? (string) Str::uuid();
        });
    }

    public function workshop(): BelongsTo
    {
        return $this->belongsTo(Workshop::class);
    }

    #[Scope]
    protected function forActivity($query, string $type)
    {
        return $query->where('activity_type', $type);
    }
}
