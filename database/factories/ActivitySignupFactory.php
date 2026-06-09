<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ActivitySignup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ActivitySignup>
 */
class ActivitySignupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'activity_type' => fake()->randomElement(['workshop', 'healing_room', 'prophetic_room', 'street_evangelism']),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
