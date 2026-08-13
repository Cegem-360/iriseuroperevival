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
     *
     * Idempotent: matches existing rows by `slug` and updates in place. Never
     * calls `Workshop::query()->delete()` — a previous version of this seeder
     * did, and running it in production on 2026-07-06 wiped every workshop's
     * `translations`, `image_path`, and admin-panel edits. Recovered via the
     * JetBackup snapshot on 2026-07-07; the destructive pattern is retired.
     */
    public function run(): void
    {
        $davidGava = Speaker::query()->where('slug', 'david-gava')->first();
        $maryPat = Speaker::query()->where('slug', 'mary-pat-gokee')->first();
        $katey = Speaker::query()->where('slug', 'katey-maddux')->first();
        $tineke = Speaker::query()->where('slug', 'tineke-bouwman')->first();
        $baoyan = Speaker::query()->where('slug', 'baoyan-lam')->first();
        $drKate = Speaker::query()->where('slug', 'dr-kate')->first();
        $yanRudy = Speaker::query()->where('slug', 'yan-rudy')->first();
        $fernando = Speaker::query()->where('slug', 'fernando-sousa')->first();
        $brianValerie = Speaker::query()->where('slug', 'brian-valerie')->first();
        $irisGlobalLeaders = Speaker::query()->where('slug', 'iris-global-leaders')->first();

        $workshops = [
            [
                'slug' => 'power-evangelism',
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
                'slug' => 'revival-harvest',
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
                'slug' => 'prophetic-arts',
                'title' => 'The Beautiful Heart of Jesus: Set Free Through Creative Movement',
                'short_description' => 'Express worship and prophetic revelation through creative arts and visual media.',
                'description' => 'Please join Dr. Kate Hartman for a transformative prophetic workshop focused on the Lord Jesus Christ, the Lover of your soul, the Healer of the brokenhearted, and the Restorer of shattered dreams. Experience His profound presence as you embark on a Holy Spirit-led journey of inner healing and newfound freedom through creative movement. Let go of the past and step into a glorious future filled with grace and hope as you encounter the beautiful heart of Jesus.',
                'leader_name' => 'Dr. Kate',
                'speaker_id' => $drKate?->id,
                'schedule_note' => 'Saturday & Sunday',
                'duration_minutes' => 90,
                'difficulty_level' => 'all',
                'sort_order' => 3,
            ],
            [
                'slug' => 'prophetic-ministry',
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
                'slug' => 'pastoral-care',
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
                'slug' => 'missions',
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
                'slug' => 'marketplace-missions',
                'title' => 'Marketplace Missions',
                'short_description' => 'Transform your workplace into a mission field and integrate faith with business.',
                'description' => 'Yan & Rudy share how to carry the Kingdom of God into the marketplace. Discover how your business and professional skills can be used for eternal impact and how to be a missionary wherever you work.',
                'leader_name' => 'Yan & Rudy',
                'speaker_id' => $yanRudy?->id,
                'schedule_note' => 'Saturday & Sunday',
                'duration_minutes' => 90,
                'difficulty_level' => 'all',
                'sort_order' => 7,
            ],
            [
                'slug' => 'family',
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
                'slug' => 'human-trafficking-awareness',
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
                // Slug kept as 'freedom-ministry' for URL/DB stability; the
                // display title changed 2026-08-13 per client to reflect the
                // workshop's actual focus.
                'slug' => 'freedom-ministry',
                'title' => 'Finding your identity',
                'short_description' => 'Identity, calling, and walking with Jesus in a simple, honest, practical way.',
                'description' => 'What if purpose is less about finding the "right thing" and more about becoming who God created you to be? In this workshop, we\'ll explore identity, calling, and what it looks like to walk with Jesus in a simple, honest, and practical way.',
                'leader_name' => 'Fernando Sousa',
                'speaker_id' => $fernando?->id,
                'schedule_note' => 'Saturday & Sunday',
                'duration_minutes' => 90,
                'difficulty_level' => 'all',
                'sort_order' => 10,
            ],
            [
                'slug' => 'father-heart-of-god',
                'title' => 'Father Heart of God',
                'short_description' => 'Encounter the deep, unconditional love of your Heavenly Father.',
                'description' => 'Brian & Valerie lead a transformative workshop on experiencing the Father\'s love. Discover the healing power of understanding your identity as a beloved child of God.',
                'leader_name' => 'Brian & Valerie',
                'speaker_id' => $brianValerie?->id,
                'schedule_note' => 'Saturday & Sunday',
                'duration_minutes' => 90,
                'difficulty_level' => 'all',
                'sort_order' => 11,
            ],
            [
                // Restored 2026-08-13 per client. Was previously deleted
                // 2026-07-07 at earlier client request that they then reversed.
                'slug' => 'iris-global-alumni-gathering',
                'title' => 'Iris Global Alumni Gathering',
                'short_description' => 'A special gathering for former students of the Iris Global Harvest School of Missions.',
                'description' => 'Heidi Baker and the Iris missionaries host a special reunion for alumni of the Iris Global Harvest School of Missions. Reconnect, share your testimony, and be refreshed together.',
                'leader_name' => 'Iris Global leaders',
                'speaker_id' => $irisGlobalLeaders?->id,
                'schedule_note' => 'Saturday & Sunday',
                'duration_minutes' => 90,
                'difficulty_level' => 'all',
                'sort_order' => 12,
            ],
        ];

        foreach ($workshops as $workshopData) {
            $slug = $workshopData['slug'];
            unset($workshopData['slug']);

            Workshop::updateOrCreate(
                ['slug' => $slug],
                [
                    ...$workshopData,
                    'is_published' => true,
                ],
            );
        }
    }
}
