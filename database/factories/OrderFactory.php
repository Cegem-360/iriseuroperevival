<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subtotal = fake()->numberBetween(1000, 50000);

        return [
            'uuid' => (string) Str::uuid(),
            'email' => fake()->email(),
            'customer_name' => fake()->name(),
            'phone' => fake()->optional()->phoneNumber(),
            'billing_address' => fake()->address(),
            'shipping_address' => fake()->optional()->address(),
            'status' => 'pending',
            'subtotal' => $subtotal,
            'discount' => 0,
            'total' => $subtotal,
            'promotion_code_id' => null,
            'stripe_session_id' => null,
            'stripe_payment_intent' => null,
            'paid_at' => null,
            'notes' => null,
        ];
    }

    public function paid(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'paid',
            'paid_at' => now(),
            'stripe_payment_intent' => 'pi_' . Str::random(24),
        ]);
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'paid_at' => now()->subDays(fake()->numberBetween(1, 30)),
        ]);
    }

    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'cancelled',
        ]);
    }

    public function refunded(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'refunded',
        ]);
    }
}
