<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Donation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Donation>
 */
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => (string) Str::uuid(),
            'amount_huf' => fake()->randomElement(Donation::PRESET_AMOUNTS_HUF),
            'status' => 'pending',
            'locale' => 'hu',
        ];
    }

    public function paid(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => 'paid',
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'stripe_session_id' => 'cs_test_' . Str::random(24),
            'stripe_payment_intent' => 'pi_' . Str::random(24),
            'paid_at' => now(),
        ]);
    }
}
