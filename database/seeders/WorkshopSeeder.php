<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Speaker;
use App\Models\Workshop;
use Illuminate\Database\Seeder;

class WorkshopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Workshop::query()->delete();

        $davidGava = Speaker::query()->where('slug', 'david-gava')->first();
        $maryPat = Speaker::query()->where('slug', 'mary-pat-gokee')->first();
        $katey = Speaker::query()->where('slug', 'katey-maddux')->first();
        $tineke = Speaker::query()->where('slug', 'tineke-bouwman')->first();
        $baoyan = Speaker::query()->where('slug', 'baoyan-lam')->first();

        $workshops = [
            [
                'title' => 'Power Evangelism',
                'short_description' => 'Learn to step out in boldness and share the Gospel with signs and wonders following.',
                'description' => 'David Gava shares from years of front-line experience in power evangelism across nations. Learn how to hear the Holy Spirit for words of knowledge on the streets, pray for the sick, and lead people to Jesus with confidence and compassion.',
                'leader_name' => 'David Gava',
                'speaker_id' => $davidGava?->id,
                'schedule_note' => 'Saturday',
                'duration_minutes' => 90,
                'difficulty_level' => 'all',
                'sort_order' => 1,
            ],
            [
                'title' => 'Revival Harvest',
                'short_description' => 'Catch the fire of revival and learn how to sustain a harvest movement in your region.',
                'description' => 'Building on decades of revival experience, David Gava teaches how to steward revival fire, disciple new believers, and build lasting fruit from harvest movements.',
                'leader_name' => 'David Gava',
                'speaker_id' => $davidGava?->id,
                'schedule_note' => 'Sunday',
                'duration_minutes' => 90,
                'difficulty_level' => 'all',
                'sort_order' => 2,
            ],
            [
                'title' => 'Prophetic Arts',
                'short_description' => 'Express worship and prophetic revelation through creative arts and visual media.',
                'description' => 'Discover how to tap into the creative flow of the Holy Spirit. This hands-on workshop explores painting, drawing, and other visual arts as expressions of worship and prophetic revelation.',
                'leader_name' => 'Dr. Kate',
                'speaker_id' => null,
                'schedule_note' => 'Saturday & Sunday',
                'duration_minutes' => 90,
                'difficulty_level' => 'all',
                'sort_order' => 3,
            ],
            [
                'title' => 'Prophetic Ministry',
                'short_description' => 'Grow in the prophetic gift and learn to minister with accuracy and love.',
                'description' => 'Tineke Bouwman, a seasoned prophetic voice, teaches how to hear God\'s voice clearly, deliver prophetic words with accuracy and love, and grow in this vital gift for the building up of the body of Christ.',
                'leader_name' => 'Tineke Bouwman',
                'speaker_id' => $tineke?->id,
                'schedule_note' => 'Saturday & Sunday',
                'duration_minutes' => 90,
                'difficulty_level' => 'all',
                'sort_order' => 4,
            ],
            [
                'title' => 'Pastoral Care',
                'short_description' => 'Practical wisdom for shepherding people through life\'s challenges with the heart of God.',
                'description' => 'Alan & Jan bring years of pastoral experience to equip leaders in the art of caring for God\'s people. Learn practical tools for counseling, spiritual guidance, and building healthy church communities.',
                'leader_name' => 'Alan & Jan',
                'speaker_id' => null,
                'schedule_note' => 'Saturday & Sunday',
                'duration_minutes' => 90,
                'difficulty_level' => 'all',
                'sort_order' => 5,
            ],
            [
                'title' => 'Missions',
                'short_description' => 'Catch a vision for global missions and learn practical steps to answer the call.',
                'description' => 'Mary Pat Gokee shares from her experience with Iris Global to inspire and equip you for cross-cultural missions, whether short-term or long-term. Learn about the harvest fields and how you can participate.',
                'leader_name' => 'Mary Pat Gokee',
                'speaker_id' => $maryPat?->id,
                'schedule_note' => 'Saturday & Sunday',
                'duration_minutes' => 90,
                'difficulty_level' => 'all',
                'sort_order' => 6,
            ],
            [
                'title' => 'Marketplace Missions',
                'short_description' => 'Transform your workplace into a mission field and integrate faith with business.',
                'description' => 'Yan & Rudy share how to carry the Kingdom of God into the marketplace. Discover how your business and professional skills can be used for eternal impact and how to be a missionary wherever you work.',
                'leader_name' => 'Yan & Rudy',
                'speaker_id' => null,
                'schedule_note' => 'Saturday & Sunday',
                'duration_minutes' => 90,
                'difficulty_level' => 'all',
                'sort_order' => 7,
            ],
            [
                'title' => 'Family',
                'short_description' => 'Biblical foundations for building strong, God-centered families in today\'s world.',
                'description' => 'Baoyan Lam brings wisdom and practical teaching on family and parenting from a biblical perspective. Learn how to build a God-honoring family culture and raise children who love Jesus.',
                'leader_name' => 'Baoyan Lam',
                'speaker_id' => $baoyan?->id,
                'schedule_note' => 'Saturday & Sunday',
                'duration_minutes' => 90,
                'difficulty_level' => 'all',
                'sort_order' => 8,
            ],
            [
                'title' => 'Human Trafficking Awareness',
                'short_description' => 'Awareness, prevention, and strategic solutions in the fight against exploitation.',
                'description' => 'Katey Maddux, founder of Mighty Warrior International, shares critical awareness about human trafficking and practical ways the church can engage in prevention, rescue, and restoration efforts.',
                'leader_name' => 'Katey Maddux',
                'speaker_id' => $katey?->id,
                'schedule_note' => 'Saturday & Sunday',
                'duration_minutes' => 90,
                'difficulty_level' => 'all',
                'sort_order' => 9,
            ],
            [
                'title' => 'Freedom Ministry',
                'short_description' => 'Walking in the freedom Christ purchased and helping others find their breakthrough.',
                'description' => 'Fernando & Nathalia share powerful testimony and biblical teaching on finding freedom in Christ. Learn how to minister deliverance and inner healing with wisdom and compassion.',
                'leader_name' => 'Fernando & Nathalia',
                'speaker_id' => null,
                'schedule_note' => 'Saturday & Sunday',
                'duration_minutes' => 90,
                'difficulty_level' => 'all',
                'sort_order' => 10,
            ],
            [
                'title' => 'Father Heart of God',
                'short_description' => 'Encounter the deep, unconditional love of your Heavenly Father.',
                'description' => 'Brian & Valerie lead a transformative workshop on experiencing the Father\'s love. Discover the healing power of understanding your identity as a beloved child of God.',
                'leader_name' => 'Brian & Valerie',
                'speaker_id' => null,
                'schedule_note' => 'Saturday & Sunday',
                'duration_minutes' => 90,
                'difficulty_level' => 'all',
                'sort_order' => 11,
            ],
        ];

        foreach ($workshops as $workshopData) {
            Workshop::create([
                ...$workshopData,
                'is_published' => true,
            ]);
        }
    }
}
