<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sponsor>
 */
class SponsorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'logo_path' => null,
            'website_url' => fake()->url(),
            'tier' => fake()->randomElement(['platinum', 'gold', 'silver', 'bronze']),
            'sort_order' => fake()->numberBetween(0, 100),
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    public function platinum(): static
    {
        return $this->state(fn (array $attributes) => [
            'tier' => 'platinum',
        ]);
    }

    public function gold(): static
    {
        return $this->state(fn (array $attributes) => [
            'tier' => 'gold',
        ]);
    }

    public function silver(): static
    {
        return $this->state(fn (array $attributes) => [
            'tier' => 'silver',
        ]);
    }

    public function bronze(): static
    {
        return $this->state(fn (array $attributes) => [
            'tier' => 'bronze',
        ]);
    }
}
