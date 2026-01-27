<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PromotionCode>
 */
class PromotionCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => strtoupper(Str::random(8)),
            'type' => 'percentage',
            'value' => fake()->randomElement([5, 10, 15, 20, 25]),
            'max_uses' => fake()->optional(0.5)->numberBetween(10, 100),
            'used_count' => 0,
            'min_order_amount' => fake()->optional(0.3)->numberBetween(1000, 5000),
            'valid_from' => null,
            'valid_until' => fake()->optional(0.5)->dateTimeBetween('now', '+3 months'),
            'is_active' => true,
            'description' => fake()->optional()->sentence(),
        ];
    }

    public function percentage(int $value = 10): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'percentage',
            'value' => $value,
        ]);
    }

    public function fixedAmount(int $valueInCents = 1000): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'fixed_amount',
            'value' => $valueInCents,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    public function expired(): static
    {
        return $this->state(fn (array $attributes) => [
            'valid_until' => now()->subDay(),
        ]);
    }

    public function unlimited(): static
    {
        return $this->state(fn (array $attributes) => [
            'max_uses' => null,
        ]);
    }

    public function exhausted(): static
    {
        return $this->state(fn (array $attributes) => [
            'max_uses' => 10,
            'used_count' => 10,
        ]);
    }
}
