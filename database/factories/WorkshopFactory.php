<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Speaker;
use App\Models\Workshop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Workshop>
 */
class WorkshopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'short_description' => fake()->paragraph(1),
            'description' => fake()->paragraphs(3, true),
            'benefits' => [
                fake()->sentence(),
                fake()->sentence(),
                fake()->sentence(),
            ],
            'capacity' => fake()->randomElement([20, 30, 50, null]),
            'duration_minutes' => fake()->randomElement([60, 90, 120]),
            'difficulty_level' => fake()->randomElement(['beginner', 'intermediate', 'advanced', 'all']),
            'requirements' => [
                fake()->sentence(),
            ],
            'is_published' => true,
            'sort_order' => 0,
        ];
    }

    public function unpublished(): static
    {
        return $this->state(fn (array $attributes): array => [
            'is_published' => false,
        ]);
    }

    public function withSpeaker(): static
    {
        return $this->state(fn (array $attributes): array => [
            'speaker_id' => Speaker::factory(),
        ]);
    }

    public function beginner(): static
    {
        return $this->state(fn (array $attributes): array => [
            'difficulty_level' => 'beginner',
        ]);
    }

    public function intermediate(): static
    {
        return $this->state(fn (array $attributes): array => [
            'difficulty_level' => 'intermediate',
        ]);
    }

    public function advanced(): static
    {
        return $this->state(fn (array $attributes): array => [
            'difficulty_level' => 'advanced',
        ]);
    }
}
