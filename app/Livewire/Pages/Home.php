<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Models\Faq;
use App\Models\ScheduleItem;
use App\Models\Speaker;
use App\Models\Sponsor;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection as SupportCollection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Europe Revival 2026 - Encounter Jesus. Catch on Fire.')]
class Home extends Component
{
    #[Computed]
    public function featuredSpeakers(): Collection
    {
        return Speaker::query()
            ->featured()
            ->ordered()
            ->get();
    }

    #[Computed]
    public function worshipTeams(): Collection
    {
        return Speaker::query()
            ->ofType('worship_team')
            ->ordered()
            ->get();
    }

    #[Computed]
    public function workshopLeaders(): Collection
    {
        return Speaker::query()
            ->ofType('workshop_leader')
            ->with('workshops')
            ->ordered()
            ->get();
    }

    #[Computed]
    public function mainSponsor(): ?Sponsor
    {
        return Sponsor::query()
            ->active()
            ->ofTier('platinum')
            ->ordered()
            ->first();
    }

    #[Computed]
    public function partnerSponsors(): Collection
    {
        return Sponsor::query()
            ->active()
            ->whereNot('tier', 'platinum')
            ->byTierPriority()
            ->ordered()
            ->get();
    }

    #[Computed]
    public function faqs(): Collection
    {
        return Faq::query()
            ->published()
            ->ordered()
            ->get();
    }

    #[Computed]
    public function scheduleDays(): SupportCollection
    {
        $scheduleItems = ScheduleItem::query()
            ->published()
            ->with('speaker')
            ->orderBy('day')
            ->orderBy('start_time')
            ->orderBy('sort_order')
            ->get()
            ->groupBy(fn (ScheduleItem $item) => Carbon::parse($item->day)->format('Y-m-d'));

        return $scheduleItems->map(function ($items, $day) {
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
    }

    public function render(): View
    {
        return view('livewire.pages.home');
    }
}
