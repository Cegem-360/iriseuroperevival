<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
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
        
        // Payment Info
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

    protected $casts = [
        'languages' => 'array',
        'is_born_again' => 'boolean',
        'is_spirit_filled' => 'boolean',
        'attended_ministry_school' => 'boolean',
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($registration) {
            if (empty($registration->uuid)) {
                $registration->uuid = (string) Str::uuid();
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeAttendees($query)
    {
        return $query->where('type', 'attendee');
    }

    public function scopeMinistryTeam($query)
    {
        return $query->where('type', 'ministry');
    }

    public function scopeVolunteers($query)
    {
        return $query->where('type', 'volunteer');
    }

    public function scopePending($query)
    {
        return $query->whereIn('status', ['pending_payment', 'pending_approval']);
    }

    public function scopePendingApproval($query)
    {
        return $query->where('status', 'pending_approval');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePaid($query)
    {
        return $query->whereNotNull('paid_at');
    }

    public function scopeByCountry($query, string $country)
    {
        return $query->where('country', $country);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getIsPaidAttribute(): bool
    {
        return !is_null($this->paid_at);
    }

    public function getIsApprovedAttribute(): bool
    {
        return $this->status === 'approved';
    }

    public function getIsPendingAttribute(): bool
    {
        return in_array($this->status, ['pending_payment', 'pending_approval']);
    }

    public function getIsRejectedAttribute(): bool
    {
        return $this->status === 'rejected';
    }

    public function getFormattedAmountAttribute(): string
    {
        return '€' . number_format($this->amount / 100, 2);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending_payment' => '<span class="badge badge-amber">Pending Payment</span>',
            'pending_approval' => '<span class="badge badge-amber">Pending Approval</span>',
            'approved' => '<span class="badge badge-success">Approved</span>',
            'rejected' => '<span class="badge bg-red-500/20 text-red-400 border-red-500/30">Rejected</span>',
            'paid' => '<span class="badge badge-success">Paid</span>',
            'cancelled' => '<span class="badge bg-stone-500/20 text-stone-400 border-stone-500/30">Cancelled</span>',
            default => '<span class="badge">Unknown</span>',
        };
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

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
