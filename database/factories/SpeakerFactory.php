<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Speaker>
 */
class SpeakerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();

        return [
            'uuid' => (string) Str::uuid(),
            'slug' => Str::slug($name),
            'name' => $name,
            'title' => fake()->jobTitle(),
            'organization' => fake()->company(),
            'country' => fake()->country(),
            'bio' => fake()->paragraphs(3, true),
            'photo_path' => null,
            'type' => fake()->randomElement(['speaker', 'worship_leader', 'host']),
            'is_featured' => fake()->boolean(20),
            'sort_order' => fake()->numberBetween(0, 100),
            'social_links' => [
                'twitter' => fake()->optional()->url(),
                'facebook' => fake()->optional()->url(),
                'instagram' => fake()->optional()->userName(),
            ],
            'translations' => null,
        ];
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }

    public function speaker(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'speaker',
        ]);
    }

    public function worshipLeader(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'worship_leader',
        ]);
    }

    public function host(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'host',
        ]);
    }
}
