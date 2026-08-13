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
                'name' => 'Mel Tari',
                'slug' => 'mel-tari',
                'title' => 'Special Guest',
                'organization' => 'Author, Like a Mighty Wind',
                'country' => 'Indonesia',
                'bio' => 'Indonesian born Mel Tari—affectionately known as "Papa Mel"—is a general of the faith. With a passionate zeal for God, Papa Mel is a sent out one that sprinkles the nations—and in turn—sends out masses into the harvest field, stoking the fires of revival through empowering, championing, divinely connecting, and building up the body. As the "Papa", he has been speaking at Iris Europe camps since their inception in 2021. Papa Mel is the author of "Like a Mighty Wind" that has inspired millions across the world.',
                'photo_path' => 'images/speakers/Mel-Tari-1.webp',
                'type' => 'speaker',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                // Heidi cannot attend; hidden from public via is_featured=false
                // per client's 2026-08-13 request. Row kept for history.
                'name' => 'Heidi Baker',
                'slug' => 'heidi-baker',
                'title' => 'Keynote Speaker',
                'organization' => 'Co-founder, Iris Global',
                'country' => 'United States',
                'bio' => 'Heidi\'s greatest passion is to live in the manifest presence of God and to carry His glory, presence and love to His body and a lost and dying world. Rolland and Heidi Baker founded Iris Ministries, now Iris Global, in 1980. In 1995, they were called to the poorest country in the world at the time, Mozambique, and faced an extreme test of the Gospel. They began by pouring out their lives among abandoned street children, and as the Holy Spirit moved miraculously, a revival movement spread throughout Mozambique\'s ten provinces. Heidi is now "Mama Aida" to thousands of people, overseeing a broad holistic ministry including Bible schools, medical clinics, church-based orphan care, and a network of thousands of churches.',
                'photo_path' => 'images/speakers/heidi-baker.webp',
                'type' => 'speaker',
                'is_featured' => false,
                'sort_order' => 99,
            ],
            [
                // Hungarian pastor added 2026-08-13 to replace Heidi.
                // Base name is EN; HungarianContentSeeder supplies the HU
                // name/title/org/bio. sort_order=10 places him last in the
                // featured lineup, after the international speakers.
                'name' => 'Zsolt Szilágyi',
                'slug' => 'szilagyi-zsolt',
                'title' => 'Pastor',
                'organization' => 'Pastor of a Free Christian Church',
                'country' => 'Hungary',
                'bio' => 'Zsolt Szilágyi serves as a pastor in Hungary and is one of the founding leaders of the National Prophetic Movement, a ministry he co-founded nearly twenty years ago. With unwavering faith, he believes that the Hungarian Church stands on the threshold of a transformative revival. Driven by this vision, he and his team work alongside Christian churches and denominations across the nation, fostering unity and equipping believers for what God is preparing to do.',
                'photo_path' => 'images/speakers/szilagyi-zsolt.webp',
                'type' => 'speaker',
                'is_featured' => true,
                'sort_order' => 10,
            ],
            [
                'name' => 'Ben Fitzgerald',
                'slug' => 'ben-fitzgerald',
                'title' => 'Evangelist, Pastor',
                'organization' => 'Pastor of the Awakening Church',
                'country' => 'Australia',
                'bio' => "Ben Fitzgerald is a passionate lover of Jesus and the senior leader of Awakening Europe and Awakening churches, a movement that champions the Gospel across Europe through stadium events, city-wide outreaches, and training schools. Originally from Melbourne, Australia, Pastor Ben met Jesus in an encounter that deeply changed him in 2002 while he lived in deep brokenness. Since then he has lived passionately about one thing – showing the world Jesus in his everyday life and taking the good news of the Kingdom to the nations. He and the team are helping many people be equipped to share the Gospel, plant new churches, and raise up a company of pure worshippers in Europe.\n\nGalatians 5:1 says \"It is for freedom that Christ has set us free.\" In line with that mission, Ben loves to equip people to live in God's fullness of freedom and identity. He has a deep conviction that the future of nations will be transformed by radical believers living free and proclaiming Jesus boldly.",
                'photo_path' => 'images/alt-style/speakers/speaker-ben.webp',
                'type' => 'speaker',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'David Gava',
                'slug' => 'david-gava',
                'title' => 'Speaker',
                'organization' => 'Missionary / Founder, Kerusso Ministry',
                'country' => 'Sweden',
                'bio' => 'David is originally from Zimbabwe, currently resides in Sweden with his wife Ingela and their two children. He is a missionary and founder of Kerusso Ministry in Sweden and Kerusso School in Brazil, which he leads alongside his family. He has spent more than two decades carrying a powerful testimony of resurrection and healing from a severe speech impediment that made public speaking a challenge until age 21—he is living proof that with God nothing is impossible. He is a servant leader, bathed in humility and gentleness, with wisdom from the King to lead an army of revivalists across the nations!',
                'photo_path' => 'images/speakers/david-gava.webp',
                'type' => 'speaker',
                'is_featured' => true,
                'sort_order' => 4,
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
                'is_featured' => false,
                'sort_order' => 5,
            ],
            // Workshop Leaders
            [
                'name' => 'Mary Pat Gokee',
                'slug' => 'mary-pat-gokee',
                'title' => 'Workshop Leader',
                'organization' => 'Prophetic Arts, Iris Global',
                'country' => 'United States',
                'bio' => "Compelled by love and worship, Mary Pat Gokee embraces loving the LORD JESUS wholeheartedly. She moves in compassionate action for the lost and hurting according to Mark 12:30-31 and Matthew 10:7-9. Mary Pat moves in prophetic fire evangelism, which includes prophetic intercession, teaching and impartation, healing and deliverance.\n\nMary Pat and her husband, William Gokee, are the Co-Founders and Co-Directors of Frontline Ministries International (FMI) and Co-Pastors of Frontline Church in Ohio, USA. They also founded Redemption for Life, which focuses on rescuing and restoring people affected by human trafficking and other atrocities.\n\nSince 1995, they have pioneered international Kingdom works. Leading missions, training missionaries, and establishing churches and ministries is Mary Pat's joy. She teaches believers how to live supernaturally, and trains leaders, prophetic intercessors and harvesters. She is on the frontlines proclaiming the Gospel worldwide.",
                'photo_path' => 'images/speakers/mary-pat-gokee.webp',
                'type' => 'workshop_leader',
                'is_featured' => false,
                'sort_order' => 10,
            ],
            [
                'name' => 'Baoyan Lam & Rudy Taslim',
                'slug' => 'baoyan-lam',
                'title' => 'Workshop Leader',
                'organization' => 'Family & Parenting, Iris Asia',
                'country' => 'China',
                'bio' => "Lam Baoyan and Rudy Taslim are missionaries, architects, and founders of Living Oaks and Genesis Architects, based in Singapore and serving globally. With strong backgrounds in architecture, business, and the marketplace, they are committed to demonstrating how professional excellence and Kingdom values can contribute to the transformation of nations. They integrate design, strategy, and social impact to deliver sustainable solutions in complex, crisis-affected, and war-torn environments.\n\nTheir work includes building wells, schools, shelters, and community infrastructure in partnership with local churches and leaders, particularly in regions affected by conflict and displacement. At the same time, they remain deeply engaged with the poor and vulnerable, believing that lasting transformation must be both systemic and compassionate.\n\nThey are recognised internationally for their leadership in humanitarian architecture and for bridging the marketplace and missions, bringing practical hope, dignity, and restoration to communities in need.",
                'photo_path' => 'images/speakers/rudy-baoyan.webp',
                'type' => 'workshop_leader',
                'is_featured' => false,
                'sort_order' => 11,
            ],
            [
                'name' => 'Katey Maddux',
                'slug' => 'katey-maddux',
                'title' => 'Workshop Leader',
                'organization' => 'Founder, KBC & MWI',
                'country' => 'United States',
                'bio' => 'Katey Maddux is a Kingdom builder and global leader dedicated to helping women walk in freedom, clarity, and bold obedience to God\'s design for their lives and families. She is the Founder of Kingdom Business Collective, a global community for Christian women entrepreneurs and leaders, and Mighty Warrior International, a nonprofit focused on prevention, awareness, and strategic solutions in the fight against human trafficking and exploitation. Her work takes shape at the intersection of business, ministry, and global mission, with initiatives and partnerships across the U.S., Europe, Africa, and Asia.',
                'photo_path' => 'images/speakers/Katey.webp',
                'type' => 'workshop_leader',
                'is_featured' => false,
                'sort_order' => 12,
            ],
            [
                'name' => 'Tineke Bouwman',
                'slug' => 'tineke-bouwman',
                'title' => 'Workshop Leader',
                'organization' => 'Founder, Lighthouse Ministries',
                'country' => 'Netherlands',
                'bio' => 'Tineke Bouwman is the founder and forerunner of Lighthouse Ministries in Rilland, the Netherlands. As a prophetic voice in this generation, she brings breakthrough and stirs fire in the hearts of those she ministers to—releasing destiny. Lighthouse is a ministry born from walking in God-given prophetic revelation. It is a Family Home (community-centered living for young adults); a house of prayer; a church; and a training center. What started with a simple yes has grown into a prophetic movement. Tineke has raised up a generation burning for Jesus who understand the value of intimate life with God. She works internationally as a counselor and trainer of leaders. A mother of five children (including a foster daughter) and eight grandchildren, she gratefully enjoys time at home with her family when she is not running with God among the nations.',
                'photo_path' => 'images/speakers/tineke-bouwman.webp',
                'type' => 'workshop_leader',
                'is_featured' => false,
                'sort_order' => 13,
            ],
            [
                'name' => 'Fernando Sousa',
                'slug' => 'fernando-sousa',
                'title' => 'Workshop Leader',
                'organization' => 'Pastor, Iris Global Lisbon',
                'country' => 'Portugal',
                'bio' => 'Fernando Sousa is a pastor with Iris Global in Lisbon who loves Jesus, enjoys equipping people in purpose and discipleship, and never says no to a good coffee.',
                'photo_path' => 'images/alt-style/workshop-leaders/sousa.webp',
                'type' => 'workshop_leader',
                'is_featured' => false,
                'sort_order' => 14,
            ],
            // Worship teams
            [
                'name' => 'Awakening Music',
                'slug' => 'awakening-music',
                'title' => 'Worship Team',
                'organization' => null,
                'country' => null,
                'bio' => null,
                'photo_path' => 'images/alt-style/awakening-worship.webp',
                'type' => 'worship_team',
                'is_featured' => false,
                'sort_order' => 1,
            ],
            [
                'name' => 'Mountain People Worship',
                'slug' => 'mountain-people-worship',
                'title' => 'Worship Team',
                'organization' => null,
                'country' => null,
                'bio' => null,
                'photo_path' => 'images/alt-style/mountain-people.webp',
                'type' => 'worship_team',
                'is_featured' => false,
                'sort_order' => 2,
            ],
            [
                'name' => 'Iris Europe Worship',
                'slug' => 'iris-europe-worship',
                'title' => 'Worship Team',
                'organization' => null,
                'country' => null,
                'bio' => null,
                'photo_path' => 'images/alt-style/iris-europe-worship.webp',
                'type' => 'worship_team',
                'is_featured' => false,
                'sort_order' => 3,
            ],
            [
                'name' => 'Heavenly Worshippers',
                'slug' => 'mennyei-imadok',
                'title' => 'Worship Team',
                'organization' => null,
                'country' => 'Hungary',
                'bio' => null,
                'photo_path' => 'images/alt-style/mennyei-imadok.webp',
                'type' => 'worship_team',
                'is_featured' => false,
                'sort_order' => 4,
            ],
            [
                'name' => 'Alabaster Worship Team',
                'slug' => 'alabastrom-worship',
                'title' => 'Worship Team',
                'organization' => null,
                'country' => 'Hungary',
                'bio' => null,
                'photo_path' => 'images/alt-style/alabastrom-worship.webp',
                'type' => 'worship_team',
                'is_featured' => false,
                'sort_order' => 5,
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
                'logo_path' => 'resources/images/iris-budapest-2026.png',
                'website_url' => 'https://irisglobal.org.uk',
                'tier' => 'platinum',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Kingdom Business Collective',
                'logo_path' => 'resources/images/partner-logos/KBC-Logo.png',
                'website_url' => null,
                'tier' => 'gold',
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Mighty Warrior International',
                'logo_path' => 'resources/images/partner-logos/MWI-Logo.png',
                'website_url' => null,
                'tier' => 'gold',
                'sort_order' => 11,
                'is_active' => true,
            ],
            [
                'name' => 'Kerusso',
                'logo_path' => 'resources/images/partner-logos/Kerusso.png',
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
            // Client's 2026-08-13 batch reordered and rewrote answers.
            // "How do I apply for the Ministry Team?" was deleted from the FAQ table.
            [
                'question' => 'Where is the conference held?',
                'answer' => 'Europe Revival 2026 will be held at BOK Hall in Budapest, Hungary. Address: 1146 Budapest, Dózsa György út 1.',
                'category' => 'general',
                'sort_order' => 2,
                'is_published' => true,
            ],
            [
                'question' => 'Where can I stay if I\'m coming for multiple days?',
                'answer' => 'Budapest offers a wide range of accommodation options in different price categories, from affordable hostels and Airbnb apartments to hotels located near the venue. If you would like assistance with accommodation, please send an email to: darainagy.judith@smart-travel.hu.',
                'category' => 'general',
                'sort_order' => 3,
                'is_published' => true,
            ],
            [
                'question' => 'What languages will be available?',
                'answer' => 'The conference will be held in both English and Hungarian. Upon request, we can provide interpretation in additional languages. If you require this service, please let us know by contacting our central email address.',
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
                'question' => 'Is childcare available?',
                'answer' => 'No.',
                'category' => 'general',
                'sort_order' => 6,
                'is_published' => true,
            ],
            [
                'question' => 'Will there be a livestream available?',
                'answer' => 'No. We encourage everyone to attend in person so that you can experience the atmosphere of revival and have the opportunity to be personally ministered to.',
                'category' => 'general',
                'sort_order' => 7,
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
