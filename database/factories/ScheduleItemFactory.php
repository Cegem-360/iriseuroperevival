<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Speaker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScheduleItem>
 */
class ScheduleItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = fake()->time('H:i');
        $endTime = date('H:i', strtotime($startTime) + 3600);

        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'day' => fake()->dateTimeBetween('2026-07-15', '2026-07-19'),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'type' => fake()->randomElement(['session', 'worship', 'break', 'meal', 'special']),
            'speaker_id' => null,
            'location' => fake()->randomElement(['Main Hall', 'Chapel', 'Conference Room A', 'Outdoor Area']),
            'translations' => null,
        ];
    }

    public function withSpeaker(?Speaker $speaker = null): static
    {
        return $this->state(fn (array $attributes) => [
            'speaker_id' => $speaker?->id ?? Speaker::factory(),
        ]);
    }

    public function session(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'session',
        ]);
    }

    public function worship(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'worship',
        ]);
    }

    public function break(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'break',
        ]);
    }

    public function meal(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'meal',
        ]);
    }

    public function special(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'special',
        ]);
    }
}
