<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => fake()->sentence() . '?',
            'answer' => fake()->paragraphs(2, true),
            'category' => fake()->randomElement(['general', 'registration', 'accommodation', 'travel']),
            'sort_order' => fake()->numberBetween(0, 100),
            'is_published' => true,
            'translations' => null,
        ];
    }

    public function unpublished(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => false,
        ]);
    }

    public function general(): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => 'general',
        ]);
    }

    public function registration(): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => 'registration',
        ]);
    }

    public function accommodation(): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => 'accommodation',
        ]);
    }

    public function travel(): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => 'travel',
        ]);
    }
}
