<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Registration;
use App\Services\StripeService;
use Illuminate\Console\Command;

use function Laravel\Prompts\confirm;

/**
 * Refund (via Stripe) and delete every registration flagged is_test = true.
 *
 * Paired with the hidden /register/__internal/{token} live-payment test route.
 * Run before/after a test cycle, or before retiring the internal-test feature
 * altogether, to keep the DB and Stripe dashboard clean.
 */
class PurgeTestRegistrations extends Command
{
    protected $signature = 'registrations:purge-tests
                            {--dry-run : List matching registrations without refunding or deleting}
                            {--force : Skip the confirmation prompt}';

    protected $description = 'Refund (via Stripe) and delete every registration flagged is_test = true.';

    public function handle(StripeService $stripe): int
    {
        $registrations = Registration::query()->where('is_test', true)->get();

        if ($registrations->isEmpty()) {
            $this->info('No test registrations found.');

            return self::SUCCESS;
        }

        $this->table(
            ['UUID', 'Name', 'Email', 'Amount', 'Paid At', 'Stripe PI'],
            $registrations->map(fn (Registration $r): array => [
                $r->uuid,
                $r->full_name,
                $r->email,
                $r->amount ? $r->formatted_amount : '—',
                $r->paid_at?->toDateTimeString() ?? '—',
                $r->stripe_payment_intent ?? '—',
            ])->toArray(),
        );

        if ($this->option('dry-run')) {
            $this->comment('[dry-run] no changes made.');

            return self::SUCCESS;
        }

        if (! $this->option('force')
            && ! confirm("Refund and delete {$registrations->count()} test registration(s)?")) {
            $this->warn('Aborted.');

            return self::SUCCESS;
        }

        $refunded = 0;
        $deleted = 0;
        $refundErrors = 0;

        foreach ($registrations as $registration) {
            $hasPayment = $registration->stripe_payment_intent && $registration->paid_at;

            if ($hasPayment) {
                if ($stripe->refund($registration)) {
                    $this->line("  ✓ Refunded {$registration->uuid}");
                    $refunded++;
                } else {
                    $this->warn("  ✗ Refund failed for {$registration->uuid} — kept, handle manually in Stripe");
                    $refundErrors++;

                    continue;
                }
            }

            $registration->workshops()->detach();
            $registration->delete();
            $deleted++;
        }

        $this->newLine();
        $this->info("Refunded: {$refunded} · Deleted: {$deleted} · Refund errors: {$refundErrors}");

        return $refundErrors > 0 ? self::FAILURE : self::SUCCESS;
    }
}
