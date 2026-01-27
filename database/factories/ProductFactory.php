<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(3, true);

        return [
            'uuid' => (string) Str::uuid(),
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'description' => fake()->paragraph(),
            'price' => fake()->numberBetween(500, 10000), // 5-100 EUR
            'type' => fake()->randomElement(['merchandise', 'ticket', 'donation']),
            'stock_quantity' => fake()->optional(0.7)->numberBetween(1, 100),
            'is_active' => true,
            'image_path' => null,
            'attributes' => null,
            'sort_order' => fake()->numberBetween(0, 100),
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    public function merchandise(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'merchandise',
            'attributes' => ['sizes' => ['S', 'M', 'L', 'XL']],
        ]);
    }

    public function ticket(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'ticket',
            'stock_quantity' => null,
        ]);
    }

    public function donation(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'donation',
            'stock_quantity' => null,
        ]);
    }

    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock_quantity' => 0,
        ]);
    }
}
