<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Speaker;
use App\Models\Sponsor;
use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedSpeakers();
        $this->seedSponsors();
        $this->seedFaqs();
    }

    protected function seedSpeakers(): void
    {
        $speakers = [
            // Featured Speakers
            [
                'name' => 'Heidi Baker',
                'slug' => 'heidi-baker',
                'title' => 'Keynote Speaker',
                'organization' => 'Iris Global',
                'country' => 'United States',
                'bio' => 'Heidi Baker is the co-founder of Iris Global, a missions organization that has planted over 10,000 churches worldwide. Known for her powerful testimony of revival in Mozambique.',
                'photo_path' => 'images/speakers/heidi-baker.webp',
                'type' => 'speaker',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Mel Tari',
                'slug' => 'mel-tari',
                'title' => 'Special Guest',
                'organization' => 'Author, Like a Mighty Wind',
                'country' => 'Indonesia',
                'bio' => 'Mel Tari is the author of "Like a Mighty Wind," documenting the Indonesian revival. His testimony of miracles, signs, and wonders continues to inspire believers worldwide.',
                'photo_path' => 'images/speakers/mel-tari.webp',
                'type' => 'speaker',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'David Gava',
                'slug' => 'david-gava',
                'title' => 'Speaker',
                'organization' => 'Iris Hungary',
                'country' => 'Hungary',
                'bio' => 'David Gava leads Iris Hungary and has been instrumental in bringing revival ministry to Central Europe.',
                'photo_path' => 'images/speakers/david-gava.webp',
                'type' => 'speaker',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Pastor Josef',
                'slug' => 'pastor-josef',
                'title' => 'Speaker',
                'organization' => 'Budapest Church',
                'country' => 'Hungary',
                'bio' => 'Pastor Josef leads one of Budapest\'s vibrant churches and is a key voice in the Hungarian Christian community.',
                'photo_path' => 'images/speakers/pastor-josef.webp',
                'type' => 'speaker',
                'is_featured' => true,
                'sort_order' => 4,
            ],
            // Workshop Leaders
            [
                'name' => 'Mary Pat Gokee',
                'slug' => 'mary-pat-gokee',
                'title' => 'Prophetic Arts',
                'organization' => 'Iris Global',
                'country' => 'United States',
                'bio' => 'Mary Pat Gokee serves with Iris Global and leads prophetic arts workshops, combining creativity with the prophetic.',
                'photo_path' => 'images/speakers/mary-pat-gokee.webp',
                'type' => 'workshop_leader',
                'is_featured' => false,
                'sort_order' => 10,
            ],
            [
                'name' => 'Katey Maddux',
                'slug' => 'katey-maddux',
                'title' => 'Human Trafficking',
                'organization' => 'Freedom Collective',
                'country' => 'United States',
                'bio' => 'Katey Maddux leads Freedom Collective, an organization dedicated to fighting human trafficking and bringing freedom to the captives.',
                'photo_path' => 'images/speakers/katey-maddux.webp',
                'type' => 'workshop_leader',
                'is_featured' => false,
                'sort_order' => 11,
            ],
            [
                'name' => 'Baoyan Lam',
                'slug' => 'baoyan-lam',
                'title' => 'Family & Parenting',
                'organization' => 'Iris Asia',
                'country' => 'China',
                'bio' => 'Baoyan Lam serves with Iris Asia and brings wisdom and practical teaching on family and parenting from a biblical perspective.',
                'photo_path' => 'images/speakers/baoyan-lam.webp',
                'type' => 'workshop_leader',
                'is_featured' => false,
                'sort_order' => 12,
            ],
        ];

        foreach ($speakers as $speaker) {
            Speaker::query()->updateOrCreate(
                ['slug' => $speaker['slug']],
                $speaker,
            );
        }
    }

    protected function seedSponsors(): void
    {
        $sponsors = [
            [
                'name' => 'IRIS Global UK',
                'logo_path' => 'images/sponsors/iris-global-uk.svg',
                'website_url' => 'https://irisglobal.org.uk',
                'tier' => 'platinum',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Kingdom Business Collective',
                'logo_path' => 'images/sponsors/kingdom-business-collective.svg',
                'website_url' => null,
                'tier' => 'gold',
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Mighty Warrior International',
                'logo_path' => 'images/sponsors/mighty-warrior-international.svg',
                'website_url' => null,
                'tier' => 'gold',
                'sort_order' => 11,
                'is_active' => true,
            ],
            [
                'name' => 'Kerusso',
                'logo_path' => 'images/sponsors/kerusso.svg',
                'website_url' => 'https://kerusso.com',
                'tier' => 'gold',
                'sort_order' => 12,
                'is_active' => true,
            ],
        ];

        foreach ($sponsors as $sponsor) {
            Sponsor::query()->updateOrCreate(
                ['name' => $sponsor['name']],
                $sponsor,
            );
        }
    }

    protected function seedFaqs(): void
    {
        $faqs = [
            [
                'question' => 'Who can attend Europe Revival 2026?',
                'answer' => 'Europe Revival is open to everyone—believers, seekers, church leaders, and anyone hungry for an encounter with God. Whether you\'re a seasoned minister or new to faith, you\'re welcome to join us in Budapest.',
                'category' => 'general',
                'sort_order' => 1,
                'is_published' => true,
            ],
            [
                'question' => 'Will there be a livestream available?',
                'answer' => 'Yes! Main sessions will be livestreamed for those who cannot attend in person. However, we highly encourage in-person attendance to fully experience the atmosphere of revival and receive personal ministry.',
                'category' => 'general',
                'sort_order' => 2,
                'is_published' => true,
            ],
            [
                'question' => 'What languages will be available?',
                'answer' => 'The conference will be held in English with simultaneous translation available in Hungarian, German, Romanian, and Russian. Translation devices will be provided at the venue.',
                'category' => 'general',
                'sort_order' => 3,
                'is_published' => true,
            ],
            [
                'question' => 'Is childcare available?',
                'answer' => 'Yes, we will have a supervised children\'s program for ages 4-12 during main sessions. Registration for childcare is required in advance. Children under 4 must be accompanied by a parent or guardian.',
                'category' => 'general',
                'sort_order' => 4,
                'is_published' => true,
            ],
            [
                'question' => 'Are meals included?',
                'answer' => 'Meals are not included in the registration fee. However, there will be food vendors on-site, and the venue is surrounded by restaurants and cafes. We\'ll also have a coffee shop area for fellowship during breaks.',
                'category' => 'general',
                'sort_order' => 5,
                'is_published' => true,
            ],
            [
                'question' => 'How do I apply for the Ministry Team?',
                'answer' => 'Ministry Team applications are open! You\'ll need to complete our application form including your testimony and pastor\'s reference. Approved team members receive free conference access in exchange for serving in healing rooms, prophetic ministry, or practical support. Applications close September 1, 2026.',
                'category' => 'registration',
                'sort_order' => 6,
                'is_published' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::query()->updateOrCreate(
                ['question' => $faq['question']],
                $faq,
            );
        }
    }
}
