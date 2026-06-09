<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\TicketPrice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<TicketPrice>
 */
class TicketPriceFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => (string) Str::uuid(),
            'ticket_type' => 'individual',
            'pricing_tier' => 'early',
            'price' => 4900,
            'label' => 'Standard Ticket',
            'description' => null,
            'is_active' => true,
            'sort_order' => 0,
        ];
    }

    public function early(): static
    {
        return $this->state(fn (array $attributes) => [
            'pricing_tier' => 'early',
        ]);
    }

    public function regular(): static
    {
        return $this->state(fn (array $attributes) => [
            'pricing_tier' => 'regular',
        ]);
    }

    public function late(): static
    {
        return $this->state(fn (array $attributes) => [
            'pricing_tier' => 'late',
        ]);
    }

    public function individual(): static
    {
        return $this->state(fn (array $attributes) => [
            'ticket_type' => 'individual',
            'label' => 'Standard Ticket',
        ]);
    }

    public function team(): static
    {
        return $this->state(fn (array $attributes) => [
            'ticket_type' => 'team',
            'label' => 'Group Pass',
        ]);
    }

    public function volunteer(): static
    {
        return $this->state(fn (array $attributes) => [
            'ticket_type' => 'volunteer',
            'label' => 'Volunteer Pass',
        ]);
    }

    public function vip(): static
    {
        return $this->state(fn (array $attributes) => [
            'ticket_type' => 'vip',
            'label' => 'VIP Pass',
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
