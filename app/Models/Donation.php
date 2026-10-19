<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\DonationFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\RouteKey;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use Override;

#[Fillable([
    'uuid',
    'amount_huf',
    'status',
    'name',
    'email',
    'locale',
    'stripe_session_id',
    'stripe_payment_intent',
    'paid_at',
])]
#[RouteKey('uuid')]
class Donation extends Model
{
    /** @use HasFactory<DonationFactory> */
    use HasFactory;

    /** @var list<int> Preset amounts (HUF) offered on the donation page. */
    public const array PRESET_AMOUNTS_HUF = [5000, 10000, 20000, 50000];

    public const int MIN_AMOUNT_HUF = 1000;

    public const int MAX_AMOUNT_HUF = 5000000;

    public const string BANK_ACCOUNT_HOLDER = 'Ararat Alapítvány';

    public const string BANK_ACCOUNT_NUMBER = 'HU51 11742135-27251838-00000000';

    public const string BANK_TRANSFER_REFERENCE = 'TAMOGATAS';

    #[Override]
    protected static function booted(): void
    {
        static::creating(function (Donation $donation): void {
            $donation->uuid ??= (string) Str::uuid();
        });
    }

    protected function casts(): array
    {
        return [
            'amount_huf' => 'integer',
            'paid_at' => 'datetime',
        ];
    }

    /**
     * Approximate euro equivalent of a HUF amount, as shown next to the prices.
     */
    public static function approximateEur(int $amountHuf): string
    {
        return '€' . Number::format(round($amountHuf / config('services.currency.eur_huf_rate')), locale: app()->getLocale());
    }

    protected function formattedAmount(): Attribute
    {
        return Attribute::make(get: fn (): string => Number::currency($this->amount_huf, 'HUF', app()->getLocale(), precision: 0));
    }

    protected function isPaid(): Attribute
    {
        return Attribute::make(get: fn (): bool => $this->status === 'paid');
    }

    public function markAsPaid(?string $paymentIntent, ?string $name = null, ?string $email = null): bool
    {
        if ($this->is_paid) {
            return true;
        }

        return $this->forceFill([
            'status' => 'paid',
            'stripe_payment_intent' => $paymentIntent,
            'paid_at' => now(),
            'name' => $this->name ?? $name,
            'email' => $this->email ?? $email,
        ])->save();
    }
}
