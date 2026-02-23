<?php

declare(strict_types=1);

use App\Models\ScheduleItem;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Training Day: consolidate into single 10am-5pm item, remove separate Lunch Break
        ScheduleItem::query()->where('id', 31)->update(['is_published' => false]); // Hide Lunch Break

        ScheduleItem::query()->where('id', 30)->update([
            'start_time' => '10:00',
            'end_time' => '17:00',
            'description' => 'Training for ministry team members and volunteers with David Gava and Iris ministry team leaders. (Lunch break included.)',
            'speaker_id' => null,
        ]);

        // Friday Opening Session: remove speaker, update description, remove "honouring the pastors"
        ScheduleItem::query()->where('id', 33)->update([
            'description' => 'Worship, Guest Speaker and Ministry Time',
            'speaker_id' => null,
        ]);

        // Saturday Morning Main Session: generic description, remove speaker
        ScheduleItem::query()->where('id', 34)->update([
            'description' => 'Worship, Guest Speaker and Ministry Time',
            'speaker_id' => null,
        ]);

        // Saturday Q&A Session: rename and remove specific names
        ScheduleItem::query()->where('id', 35)->update([
            'title' => 'Interactive Q&A Session',
            'description' => 'Interactive Q&A session with special guests',
        ]);

        // Saturday Evening Session: generic description, remove speaker
        ScheduleItem::query()->where('id', 41)->update([
            'description' => 'Worship, Guest Speaker and Ministry Time',
            'speaker_id' => null,
        ]);

        // Sunday Morning Main Session: generic description
        ScheduleItem::query()->where('id', 42)->update([
            'description' => 'Worship, Guest Speaker and Ministry Time',
        ]);

        // Sunday Afternoon Session: generic description, remove speaker
        ScheduleItem::query()->where('id', 43)->update([
            'description' => 'Worship, Guest Speaker and Ministry Time',
            'speaker_id' => null,
        ]);

        // Sunday Closing Session: generic description, remove speaker
        ScheduleItem::query()->where('id', 49)->update([
            'description' => 'Worship, Guest Speaker and Ministry Time',
            'speaker_id' => null,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restore Lunch Break
        ScheduleItem::query()->where('id', 31)->update(['is_published' => true]);

        // Restore Training Day
        ScheduleItem::query()->where('id', 30)->update([
            'start_time' => '10:00',
            'end_time' => '17:00',
            'description' => 'All-day training for ministry team members with David Gava and ministry team leaders.',
            'speaker_id' => 3,
        ]);

        // Restore original descriptions and speakers
        ScheduleItem::query()->where('id', 33)->update([
            'description' => 'Opening worship and message. Honouring the pastors of the city.',
            'speaker_id' => 3,
        ]);

        ScheduleItem::query()->where('id', 34)->update([
            'description' => 'Morning worship, message and ministry time.',
            'speaker_id' => 4,
        ]);

        ScheduleItem::query()->where('id', 35)->update([
            'title' => 'Q&A Session',
            'description' => 'Interactive Q&A session with Mel Tari and David Gava.',
        ]);

        ScheduleItem::query()->where('id', 41)->update([
            'description' => 'Evening worship, message and ministry time.',
            'speaker_id' => 2,
        ]);

        ScheduleItem::query()->where('id', 42)->update([
            'description' => 'Morning worship, message and ministry time with Mel Tari and David Gava.',
        ]);

        ScheduleItem::query()->where('id', 43)->update([
            'description' => 'Worship, message and ministry time with Heidi Baker and Iris Missionaries.',
            'speaker_id' => 1,
        ]);

        ScheduleItem::query()->where('id', 49)->update([
            'description' => 'Closing worship, message and ministry time with Heidi Baker.',
            'speaker_id' => 1,
        ]);
    }
};
