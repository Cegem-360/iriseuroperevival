<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Override;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'type',
        'status',

        // Personal Info
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
        'city',

        // Ticket Info (Attendees)
        'ticket_type',
        'ticket_quantity',
        'amount',

        // Ministry Team Fields
        'citizenship',
        'languages',
        'occupation',
        'church_name',
        'church_city',
        'pastor_name',
        'pastor_email',
        'is_born_again',
        'is_spirit_filled',
        'testimony',
        'attended_ministry_school',
        'ministry_school_name',
        'reference_1_name',
        'reference_1_email',
        'reference_2_name',
        'reference_2_email',
        'invited_by',

        // Reference Tracking
        'reference_1_contacted_at',
        'reference_1_status',
        'reference_1_response',
        'reference_2_contacted_at',
        'reference_2_status',
        'reference_2_response',

        // Email Tracking
        'confirmation_email_sent_at',

        // Payment Info
        'stripe_customer_id',
        'stripe_session_id',
        'stripe_payment_intent',
        'paid_at',

        // Approval Workflow
        'approved_at',
        'approved_by',
        'rejected_at',
        'rejected_by',
        'rejection_reason',
        'admin_notes',
    ];

    #[Override]
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($registration): void {
            if (empty($registration->uuid)) {
                $registration->uuid = (string) Str::uuid();
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Scope to find registrations for a user by user_id or email.
     */
    #[Scope]
    protected function forUser($query, User $user)
    {
        return $query->where('user_id', $user->id)
            ->orWhere('email', $user->email);
    }

    #[Scope]
    protected function attendees($query)
    {
        return $query->where('type', 'attendee');
    }

    #[Scope]
    protected function ministryTeam($query)
    {
        return $query->where('type', 'ministry');
    }

    #[Scope]
    protected function volunteers($query)
    {
        return $query->where('type', 'volunteer');
    }

    #[Scope]
    protected function pending($query)
    {
        return $query->whereIn('status', ['pending_payment', 'pending_approval']);
    }

    #[Scope]
    protected function pendingApproval($query)
    {
        return $query->where('status', 'pending_approval');
    }

    #[Scope]
    protected function approved($query)
    {
        return $query->where('status', 'approved');
    }

    #[Scope]
    protected function paid($query)
    {
        return $query->whereNotNull('paid_at');
    }

    #[Scope]
    protected function byCountry($query, string $country)
    {
        return $query->where('country', $country);
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(get: fn (): string => "{$this->first_name} {$this->last_name}");
    }

    protected function isPaid(): Attribute
    {
        return Attribute::make(get: fn (): bool => ! is_null($this->paid_at));
    }

    protected function isApproved(): Attribute
    {
        return Attribute::make(get: fn (): bool => $this->status === 'approved');
    }

    protected function isPending(): Attribute
    {
        return Attribute::make(get: fn (): bool => in_array($this->status, ['pending_payment', 'pending_approval']));
    }

    protected function isRejected(): Attribute
    {
        return Attribute::make(get: fn (): bool => $this->status === 'rejected');
    }

    protected function formattedAmount(): Attribute
    {
        return Attribute::make(get: fn (): string => '€' . number_format($this->amount / 100, 2));
    }

    protected function statusBadge(): Attribute
    {
        return Attribute::make(get: fn (): string => match ($this->status) {
            'pending_payment' => '<span class="badge badge-amber">Pending Payment</span>',
            'pending_approval' => '<span class="badge badge-amber">Pending Approval</span>',
            'approved' => '<span class="badge badge-success">Approved</span>',
            'rejected' => '<span class="badge bg-red-500/20 text-red-400 border-red-500/30">Rejected</span>',
            'paid' => '<span class="badge badge-success">Paid</span>',
            'cancelled' => '<span class="badge bg-stone-500/20 text-stone-400 border-stone-500/30">Cancelled</span>',
            default => '<span class="badge">Unknown</span>',
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Methods
    |--------------------------------------------------------------------------
    */

    public function approve(?int $adminId = null): bool
    {
        $this->status = 'approved';
        $this->approved_at = now();
        $this->approved_by = $adminId;

        return $this->save();
    }

    public function reject(?int $adminId = null, ?string $reason = null): bool
    {
        $this->status = 'rejected';
        $this->rejected_at = now();
        $this->rejected_by = $adminId;
        $this->rejection_reason = $reason;

        return $this->save();
    }

    public function markAsPaid(string $paymentIntent): bool
    {
        $this->status = 'paid';
        $this->stripe_payment_intent = $paymentIntent;
        $this->paid_at = now();

        return $this->save();
    }

    public function cancel(): bool
    {
        $this->status = 'cancelled';

        return $this->save();
    }

    /*
    |--------------------------------------------------------------------------
    | Route Model Binding
    |--------------------------------------------------------------------------
    */

    #[Override]
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    protected function casts(): array
    {
        return [
            'languages' => 'array',
            'is_born_again' => 'boolean',
            'is_spirit_filled' => 'boolean',
            'attended_ministry_school' => 'boolean',
            'amount' => 'decimal:2',
            'paid_at' => 'datetime',
            'approved_at' => 'datetime',
            'rejected_at' => 'datetime',
            'reference_1_contacted_at' => 'datetime',
            'reference_2_contacted_at' => 'datetime',
            'confirmation_email_sent_at' => 'datetime',
        ];
    }
}
