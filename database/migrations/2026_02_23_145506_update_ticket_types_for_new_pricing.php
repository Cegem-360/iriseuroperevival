<?php

declare(strict_types=1);

use App\Models\TicketPrice;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Rename "individual" to "3day" (3-Day Pass)
        TicketPrice::query()->where('ticket_type', 'individual')->update([
            'ticket_type' => '3day',
            'label' => '3-Day Pass',
            'sort_order' => 3,
        ]);

        // Rename "team" to "group" (Group Ticket)
        TicketPrice::query()->where('ticket_type', 'team')->update([
            'ticket_type' => 'group',
            'label' => 'Group Ticket',
            'sort_order' => 5,
        ]);

        // Deactivate volunteer tickets (volunteers now use coupon codes)
        TicketPrice::query()->where('ticket_type', 'volunteer')->update([
            'is_active' => false,
        ]);

        // Add 1-day ticket prices
        TicketPrice::query()->create([
            'ticket_type' => '1day',
            'pricing_tier' => 'early',
            'price' => 2900,
            'label' => '1-Day Pass',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        TicketPrice::query()->create([
            'ticket_type' => '1day',
            'pricing_tier' => 'regular',
            'price' => 3900,
            'label' => '1-Day Pass',
            'sort_order' => 2,
            'is_active' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove 1-day tickets
        TicketPrice::query()->where('ticket_type', '1day')->delete();

        // Restore "3day" back to "individual"
        TicketPrice::query()->where('ticket_type', '3day')->update([
            'ticket_type' => 'individual',
            'label' => 'Standard Ticket',
            'sort_order' => 1,
        ]);

        // Restore "group" back to "team"
        TicketPrice::query()->where('ticket_type', 'group')->update([
            'ticket_type' => 'team',
            'label' => 'Group Pass',
            'sort_order' => 3,
        ]);

        // Reactivate volunteer tickets
        TicketPrice::query()->where('ticket_type', 'volunteer')->update([
            'is_active' => true,
        ]);
    }
};
