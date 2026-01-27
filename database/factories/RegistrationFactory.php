<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Registration;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Registration>
 */
class RegistrationFactory extends Factory
{
    protected $model = Registration::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => (string) Str::uuid(),
            'type' => fake()->randomElement(['attendee', 'ministry', 'volunteer']),
            'status' => 'pending_payment',
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'country' => fake()->countryCode(),
            'city' => fake()->city(),
            'ticket_type' => fake()->randomElement(['individual', 'team']),
            'ticket_quantity' => 1,
            'amount' => fake()->randomElement([5000, 10000, 15000, 25000]),
        ];
    }

    public function attendee(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'attendee',
            'status' => 'pending_payment',
        ]);
    }

    public function ministry(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'ministry',
            'status' => 'pending_approval',
            'citizenship' => fake()->country(),
            'languages' => [fake()->languageCode(), fake()->languageCode()],
            'occupation' => fake()->jobTitle(),
            'church_name' => fake()->company() . ' Church',
            'church_city' => fake()->city(),
            'pastor_name' => fake()->name(),
            'pastor_email' => fake()->safeEmail(),
            'is_born_again' => true,
            'is_spirit_filled' => true,
            'testimony' => fake()->paragraphs(2, true),
            'attended_ministry_school' => fake()->boolean(),
            'reference_1_name' => fake()->name(),
            'reference_1_email' => fake()->safeEmail(),
            'reference_2_name' => fake()->name(),
            'reference_2_email' => fake()->safeEmail(),
            'amount' => 0,
        ]);
    }

    public function volunteer(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'volunteer',
            'status' => 'pending_approval',
            'amount' => 0,
        ]);
    }

    public function paid(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'paid',
            'stripe_payment_intent' => 'pi_' . fake()->uuid(),
            'paid_at' => now(),
        ]);
    }

    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => null,
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
            'rejected_at' => now(),
            'rejected_by' => null,
            'rejection_reason' => fake()->sentence(),
        ]);
    }
}
