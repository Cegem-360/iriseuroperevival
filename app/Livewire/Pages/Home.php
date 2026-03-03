<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Models\Faq;
use App\Models\ScheduleItem;
use App\Models\Speaker;
use App\Models\Sponsor;
use App\Models\TicketPrice;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Europe Revival 2026 - Encounter Jesus. Catch on Fire.')]
class Home extends Component
{
    public function render(): View
    {
        $featuredSpeakers = Speaker::query()
            ->featured()
            ->ordered()
            ->get();

        $worshipTeams = Speaker::query()
            ->ofType('worship_team')
            ->ordered()
            ->get();

        $workshopLeaders = Speaker::query()
            ->ofType('workshop_leader')
            ->with('workshops')
            ->ordered()
            ->get();

        $mainSponsor = Sponsor::query()
            ->active()
            ->ofTier('platinum')
            ->ordered()
            ->first();

        $partnerSponsors = Sponsor::query()
            ->active()
            ->whereNot('tier', 'platinum')
            ->byTierPriority()
            ->ordered()
            ->get();

        $faqs = Faq::query()
            ->published()
            ->ordered()
            ->get();

        // Fetch schedule items grouped by day
        $scheduleItems = ScheduleItem::query()
            ->published()
            ->with('speaker')
            ->orderBy('day')
            ->orderBy('start_time')
            ->orderBy('sort_order')
            ->get()
            ->groupBy(function (ScheduleItem $item) {
                return Carbon::parse($item->day)->format('Y-m-d');
            });

        // Prepare schedule days with metadata
        $scheduleDays = $scheduleItems->map(function ($items, $day) {
            $date = Carbon::parse($day);

            return [
                'date' => $day,
                'formatted_date' => $date->format('l, M j'),
                'short_date' => $date->format('M j'),
                'day_name' => $date->format('l'),
                'is_training_day' => $date->format('Y-m-d') === '2026-10-22',
                'items' => $items,
            ];
        });

        $ticketPrices = TicketPrice::query()
            ->active()
            ->whereIn('ticket_type', ['1day', '3day', 'group'])
            ->get()
            ->groupBy('pricing_tier')
            ->map(fn ($tierPrices) => $tierPrices->pluck('price_in_euros', 'ticket_type'));

        return view('livewire.pages.home', [
            'featuredSpeakers' => $featuredSpeakers,
            'worshipTeams' => $worshipTeams,
            'workshopLeaders' => $workshopLeaders,
            'mainSponsor' => $mainSponsor,
            'partnerSponsors' => $partnerSponsors,
            'faqs' => $faqs,
            'scheduleDays' => $scheduleDays,
            'ticketPrices' => $ticketPrices,
        ]);
    }
}
