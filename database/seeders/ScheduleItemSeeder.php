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
        $speakers = Speaker::query()->where('type', 'speaker')->get();

        $schedule = [
            // Day 1 - Thursday, August 6
            [
                'day' => '2026-08-06',
                'items' => [
                    ['start' => '14:00', 'end' => '16:00', 'title' => 'Registration & Check-in', 'type' => 'special', 'location' => 'Main Lobby'],
                    ['start' => '16:30', 'end' => '17:30', 'title' => 'Welcome Coffee & Fellowship', 'type' => 'break', 'location' => 'Café Area'],
                    ['start' => '18:00', 'end' => '19:30', 'title' => 'Opening Worship & Welcome', 'type' => 'worship', 'location' => 'Main Hall', 'speaker' => true],
                    ['start' => '19:30', 'end' => '21:00', 'title' => 'Opening Session: "The Fire of Revival"', 'type' => 'session', 'location' => 'Main Hall', 'speaker' => true, 'description' => 'Setting the tone for the conference with a powerful message about the fire of revival sweeping across Europe.'],
                ],
            ],
            // Day 2 - Friday, August 7
            [
                'day' => '2026-08-07',
                'items' => [
                    ['start' => '07:00', 'end' => '08:00', 'title' => 'Morning Prayer', 'type' => 'worship', 'location' => 'Chapel'],
                    ['start' => '08:00', 'end' => '09:00', 'title' => 'Breakfast', 'type' => 'meal', 'location' => 'Dining Hall'],
                    ['start' => '09:30', 'end' => '11:00', 'title' => 'Morning Session: "Awakening the Nations"', 'type' => 'session', 'location' => 'Main Hall', 'speaker' => true, 'description' => 'A prophetic word for the nations of Europe and Gods plan for awakening.'],
                    ['start' => '11:00', 'end' => '11:30', 'title' => 'Coffee Break', 'type' => 'break', 'location' => 'Café Area'],
                    ['start' => '11:30', 'end' => '13:00', 'title' => 'Workshops Session 1', 'type' => 'session', 'location' => 'Various Rooms', 'description' => 'Choose from multiple workshop tracks.'],
                    ['start' => '13:00', 'end' => '14:30', 'title' => 'Lunch', 'type' => 'meal', 'location' => 'Dining Hall'],
                    ['start' => '15:00', 'end' => '16:30', 'title' => 'Workshops Session 2', 'type' => 'session', 'location' => 'Various Rooms', 'description' => 'Continue with your chosen workshop track.'],
                    ['start' => '17:00', 'end' => '18:30', 'title' => 'Free Time & Recreation', 'type' => 'break', 'location' => 'Campus'],
                    ['start' => '18:30', 'end' => '19:30', 'title' => 'Dinner', 'type' => 'meal', 'location' => 'Dining Hall'],
                    ['start' => '20:00', 'end' => '22:00', 'title' => 'Evening Celebration: Worship & Ministry', 'type' => 'worship', 'location' => 'Main Hall', 'speaker' => true, 'description' => 'An extended time of worship and ministry with personal prayer available.'],
                ],
            ],
            // Day 3 - Saturday, August 8
            [
                'day' => '2026-08-08',
                'items' => [
                    ['start' => '07:00', 'end' => '08:00', 'title' => 'Morning Prayer', 'type' => 'worship', 'location' => 'Chapel'],
                    ['start' => '08:00', 'end' => '09:00', 'title' => 'Breakfast', 'type' => 'meal', 'location' => 'Dining Hall'],
                    ['start' => '09:30', 'end' => '11:00', 'title' => 'Morning Session: "Unity in the Spirit"', 'type' => 'session', 'location' => 'Main Hall', 'speaker' => true, 'description' => 'Exploring the power of unity across denominations and nations.'],
                    ['start' => '11:00', 'end' => '11:30', 'title' => 'Coffee Break', 'type' => 'break', 'location' => 'Café Area'],
                    ['start' => '11:30', 'end' => '13:00', 'title' => 'Panel Discussion: "Revival in Europe Today"', 'type' => 'session', 'location' => 'Main Hall', 'speaker' => true, 'description' => 'Hear testimonies and insights from leaders across different European nations.'],
                    ['start' => '13:00', 'end' => '14:30', 'title' => 'Lunch', 'type' => 'meal', 'location' => 'Dining Hall'],
                    ['start' => '15:00', 'end' => '16:30', 'title' => 'Outreach & City Prayer Walk', 'type' => 'special', 'location' => 'City Center', 'description' => 'Join us as we pray over the city and share God\'s love.'],
                    ['start' => '17:00', 'end' => '18:30', 'title' => 'Free Time', 'type' => 'break', 'location' => 'Campus'],
                    ['start' => '18:30', 'end' => '19:30', 'title' => 'Dinner', 'type' => 'meal', 'location' => 'Dining Hall'],
                    ['start' => '20:00', 'end' => '22:30', 'title' => 'Night of Encounter', 'type' => 'worship', 'location' => 'Main Hall', 'speaker' => true, 'description' => 'A powerful evening of worship, prophetic ministry, and encounters with the Holy Spirit.'],
                ],
            ],
            // Day 4 - Sunday, August 9
            [
                'day' => '2026-08-09',
                'items' => [
                    ['start' => '08:00', 'end' => '09:00', 'title' => 'Breakfast', 'type' => 'meal', 'location' => 'Dining Hall'],
                    ['start' => '09:30', 'end' => '12:00', 'title' => 'Closing Celebration Service', 'type' => 'worship', 'location' => 'Main Hall', 'speaker' => true, 'description' => 'Our final gathering with worship, communion, commissioning, and sending.'],
                    ['start' => '12:00', 'end' => '13:00', 'title' => 'Farewell Lunch', 'type' => 'meal', 'location' => 'Dining Hall'],
                    ['start' => '13:00', 'end' => '15:00', 'title' => 'Departure', 'type' => 'special', 'location' => 'Main Lobby'],
                ],
            ],
        ];

        $speakerIndex = 0;

        foreach ($schedule as $daySchedule) {
            foreach ($daySchedule['items'] as $item) {
                $speakerId = null;
                if (isset($item['speaker']) && $item['speaker'] && $speakers->count() > 0) {
                    $speakerId = $speakers->get($speakerIndex % $speakers->count())?->id;
                    $speakerIndex++;
                }

                ScheduleItem::create([
                    'title' => $item['title'],
                    'description' => $item['description'] ?? null,
                    'day' => $daySchedule['day'],
                    'start_time' => $item['start'],
                    'end_time' => $item['end'],
                    'type' => $item['type'],
                    'location' => $item['location'],
                    'speaker_id' => $speakerId,
                ]);
            }
        }
    }
}
