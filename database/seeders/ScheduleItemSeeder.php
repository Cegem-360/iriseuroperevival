<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ScheduleItem;
use App\Models\Speaker;
use Illuminate\Database\Seeder;

class ScheduleItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing schedule items
        ScheduleItem::query()->delete();

        // Get speakers by slug for specific assignments
        $davidGava = Speaker::query()->where('slug', 'david-gava')->first();
        $heidi = Speaker::query()->where('slug', 'heidi-baker')->first();
        $melTari = Speaker::query()->where('slug', 'mel-tari')->first();
        $pastorJosef = Speaker::query()->where('slug', 'pastor-josef')->first();

        $schedule = [
            // THURSDAY - Training Day for Ministry Team
            [
                'day' => '2026-10-22',
                'items' => [
                    ['start' => '09:00', 'end' => '10:00', 'title' => 'Registration & Check-in', 'type' => 'special', 'location' => 'Main Lobby'],
                    ['start' => '10:00', 'end' => '17:00', 'title' => 'Ministry Team Training Day', 'type' => 'session', 'location' => 'Main Hall', 'speaker_id' => $davidGava?->id, 'description' => 'All-day training for ministry team members with David Gava and ministry team leaders.'],
                    ['start' => '12:30', 'end' => '13:30', 'title' => 'Lunch Break', 'type' => 'meal', 'location' => 'Dining Hall'],
                ],
            ],
            // FRIDAY
            [
                'day' => '2026-10-23',
                'items' => [
                    ['start' => '11:00', 'end' => '14:00', 'title' => 'Pastors & Leaders Session', 'type' => 'session', 'location' => 'Main Hall', 'speaker_id' => $melTari?->id, 'description' => 'Special session for pastors, ministry leaders and business leaders with coffee, tea, and refreshments.'],
                    ['start' => '18:30', 'end' => '22:00', 'title' => 'Opening Session', 'type' => 'session', 'location' => 'Main Hall', 'speaker_id' => $davidGava?->id, 'description' => 'Opening worship and message. Honouring the pastors of the city.'],
                ],
            ],
            // SATURDAY
            [
                'day' => '2026-10-24',
                'items' => [
                    ['start' => '09:00', 'end' => '12:00', 'title' => 'Saturday Morning Main Session', 'type' => 'session', 'location' => 'Main Hall', 'speaker_id' => $pastorJosef?->id, 'description' => 'Morning worship, message and ministry time.'],
                    ['start' => '12:30', 'end' => '14:00', 'title' => 'Q&A Session', 'type' => 'session', 'location' => 'Main Hall', 'description' => 'Interactive Q&A session with Mel Tari and David Gava.'],
                    ['start' => '14:30', 'end' => '18:00', 'title' => 'Healing Rooms', 'type' => 'special', 'location' => 'Healing Rooms', 'description' => '15-minute personal ministry slots available upon prior registration.'],
                    ['start' => '14:30', 'end' => '18:00', 'title' => 'Prophetic Rooms', 'type' => 'special', 'location' => 'Prophetic Rooms', 'description' => '15-minute personal ministry slots available upon prior registration.'],
                    ['start' => '14:30', 'end' => '17:00', 'title' => 'Street Evangelism', 'type' => 'special', 'location' => 'Belváros', 'description' => 'Outreach teams going into the city to share the Gospel.'],
                    ['start' => '14:30', 'end' => '18:00', 'title' => 'Merch & Ministry Booths', 'type' => 'special', 'location' => 'Foyer', 'description' => 'Browse ministry resources and connect with partner organizations.'],
                    ['start' => '16:00', 'end' => '17:30', 'title' => 'Workshops', 'type' => 'session', 'location' => 'Various Rooms', 'description' => 'Choose from workshops on Power Evangelism, Prophetic Arts, Prophetic Ministry, Pastoral Care, Missions, Marketplace Missions, Family, Human Trafficking Awareness, Freedom Ministry, and Father Heart of God.'],
                    ['start' => '18:30', 'end' => '22:00', 'title' => 'Saturday Evening Session', 'type' => 'session', 'location' => 'Main Hall', 'speaker_id' => $melTari?->id, 'description' => 'Evening worship, message and ministry time.'],
                ],
            ],
            // SUNDAY
            [
                'day' => '2026-10-25',
                'items' => [
                    ['start' => '09:00', 'end' => '12:00', 'title' => 'Sunday Morning Main Session', 'type' => 'session', 'location' => 'Main Hall', 'description' => 'Morning worship, message and ministry time with Mel Tari and David Gava.'],
                    ['start' => '12:30', 'end' => '14:00', 'title' => 'Sunday Afternoon Session', 'type' => 'session', 'location' => 'Main Hall', 'speaker_id' => $heidi?->id, 'description' => 'Worship, message and ministry time with Heidi Baker and Iris Missionaries.'],
                    ['start' => '14:30', 'end' => '18:00', 'title' => 'Healing Rooms', 'type' => 'special', 'location' => 'Healing Rooms', 'description' => '15-minute personal ministry slots available upon prior registration.'],
                    ['start' => '14:30', 'end' => '18:00', 'title' => 'Prophetic Rooms', 'type' => 'special', 'location' => 'Prophetic Rooms', 'description' => '15-minute personal ministry slots available upon prior registration.'],
                    ['start' => '14:30', 'end' => '17:00', 'title' => 'Street Evangelism', 'type' => 'special', 'location' => 'Belváros', 'description' => 'Outreach teams going into the city to share the Gospel.'],
                    ['start' => '14:30', 'end' => '18:00', 'title' => 'Merch & Ministry Booths', 'type' => 'special', 'location' => 'Foyer', 'description' => 'Browse ministry resources and connect with partner organizations.'],
                    ['start' => '16:00', 'end' => '17:30', 'title' => 'Workshops', 'type' => 'session', 'location' => 'Various Rooms', 'description' => 'Choose from workshops including Iris Global Harvest School of Missions alumni gathering, Revival Harvest, Prophetic Arts, Prophetic Ministry, Pastoral Care, Missions, Marketplace Missions, Family, Human Trafficking Awareness, Freedom Ministry, and Father Heart of God.'],
                    ['start' => '18:30', 'end' => '22:00', 'title' => 'Closing Session', 'type' => 'session', 'location' => 'Main Hall', 'speaker_id' => $heidi?->id, 'description' => 'Closing worship, message and ministry time with Heidi Baker.'],
                ],
            ],
        ];

        foreach ($schedule as $daySchedule) {
            foreach ($daySchedule['items'] as $sortOrder => $item) {
                ScheduleItem::create([
                    'title' => $item['title'],
                    'description' => $item['description'] ?? null,
                    'day' => $daySchedule['day'],
                    'start_time' => $item['start'],
                    'end_time' => $item['end'],
                    'type' => $item['type'],
                    'location' => $item['location'],
                    'speaker_id' => $item['speaker_id'] ?? null,
                    'is_published' => true,
                    'sort_order' => $sortOrder,
                ]);
            }
        }
    }
}
