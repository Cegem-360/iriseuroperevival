<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Speaker;
use App\Models\Workshop;
use Illuminate\Database\Seeder;

class UpdateContentFromBriefSeeder extends Seeder
{
    public function run(): void
    {
        $this->updateSpeakers();
        $this->updateWorkshops();
    }

    private function updateSpeakers(): void
    {
        $bios = [
            'heidi-baker' => 'Heidi\'s greatest passion is to live in the manifest presence of God and to carry His glory, presence and love to His body and a lost and dying world. She longs to see others laying their lives down for the sake of the Gospel and coming home to the Father\'s love. Rolland and Heidi Baker founded Iris Ministries, now Iris Global, in 1980. In 1995, they were called to the poorest country in the world at the time, Mozambique, and faced an extreme test of the Gospel. They began by pouring out their lives among abandoned street children, and as the Holy Spirit moved miraculously in many ways, a revival movement spread to adults, pastors, churches and then throughout the villages all across Mozambique\'s ten provinces. Heidi is now "Mama Aida" to thousands of people, and oversees a broad holistic ministry that includes Iris university, Bible schools, medical clinics, church-based orphan care, well drilling, food aid, primary and secondary schools, farms, widow\'s programs, and outreaches that include a network of thousands of churches and prayer houses. She earned her BA and MA degrees from S.C.C., Vanguard University and her PhD from Kings College, University of London. Heidi is calling for a passionate tribe of true believers in Jesus who will pour out their lives for love\'s sake, empowered by the Holy Spirit to bring people of all ages home to the Father\'s embrace!',

            'mel-tari' => "Indonesian born Mel Tari—affectionately known as \"Papa Mel\"—is a general of the faith.\n\nWith a passionate zeal for God, Papa Mel is a sent out one that sprinkles the nations—and in turn—sends out masses into the harvest field, stoking the fires of revival through empowering, championing, divinely connecting, and building up the body. As the \"Papa\", he has been speaking at Iris Europe camps since their inception in 2021.\n\nPapa Mel is the author of \"Like a Mighty Wind\" that has inspired millions across the world.\n\nRolland's best man in his marriage to Heidi in 1980, Papa Mel's enduring friendship through all seasons shows us what is possible when you run together long distance.",

            'katey-maddux' => "Katey Maddux is a Kingdom builder and global leader dedicated to helping women walk in freedom, clarity, and bold obedience to God's design for their lives and families. She is the Founder of Kingdom Business Collective, a global community for Christian women entrepreneurs and leaders, and Mighty Warrior International, a nonprofit focused on prevention, awareness, and strategic solutions in the fight against human trafficking and exploitation.\n\nWith a background spanning fashion, accounting, and leadership, Katey brings a rare blend of spiritual discernment and practical strategy. She is known for her ability to identify gaps, build sustainable systems, and activate women into their God-given assignments—locally and globally.\n\nHer work takes shape at the intersection of business, ministry, and global mission, with initiatives and partnerships across the U.S., Europe, Africa, and Asia. At the core of everything Katey builds is a deep conviction that freedom is not optional, legacy is intentional, and every woman carries a divine blueprint she is called to steward in this generation.",

            'mary-pat-gokee' => "Compelled by love and worship, Mary Pat Gokee embraces loving the Lord Jesus wholeheartedly. She moves in compassionate action for the lost and hurting according to Mark 12:30-31 and Matthew 10:7-9. Mary Pat moves in prophetic fire evangelism, which includes prophetic intercession, teaching and impartation, healing and deliverance.\n\nMary Pat and her husband, William Gokee, are the Co-Founders and Co-Directors of Frontline Ministries International (FMI) and Co-Pastors of Frontline Church in Ohio, USA. They also founded Redemption for Life, which focuses on rescuing and restoring people affected by human trafficking and other atrocities.\n\nSince 1995, they have pioneered international Kingdom works. Leading missions, training missionaries, and establishing churches and ministries is Mary Pat's joy. She teaches believers how to live supernaturally, and trains leaders, prophetic intercessors and harvesters. She is on the frontlines proclaiming the Gospel worldwide.",

            'baoyan-lam' => "Lam Baoyan and Rudy Taslim are missionaries, architects, and founders of Living Oaks and Genesis Architects, based in Singapore and serving globally. With strong backgrounds in architecture, business, and the marketplace, they are committed to demonstrating how professional excellence and Kingdom values can contribute to the transformation of nations. They integrate design, strategy, and social impact to deliver sustainable solutions in complex, crisis-affected, and war-torn environments.\n\nTheir work includes building wells, schools, shelters, and community infrastructure in partnership with local churches and leaders, particularly in regions affected by conflict and displacement. At the same time, they remain deeply engaged with the poor and vulnerable, believing that lasting transformation must be both systemic and compassionate.\n\nThey are recognised internationally for their leadership in humanitarian architecture and for bridging the marketplace and missions, bringing practical hope, dignity, and restoration to communities in need.",

            'dr-kate' => "Dr. Kate Hartman received her commission from the Lord Yeshua-Jesus in a life-changing dream in 1994 and has dedicated over 25 years to full-time service as an ordained minister. She holds multiple earned doctoral degrees. Dr. Hartman founded a Christian university and a homeschool support program, and she and her husband, Greg, have planted and pastored several churches.\n\nDr. Hartman has served on various apostolic leadership teams both nationally and internationally, training leaders in prayer, inner healing, worship dance, outreach, discipleship, education, and community development. She is an accomplished speaker at pastoral conferences and revival services, and she organizes Messianic events through her traveling ministry, Life Spirit Fire Ministries, impacting communities across five continents.",

            'brian-valerie' => "Brian Britton is the Founder and Director of the Harvest Family Network with members around the world. He has served as a local church pastor in a revival culture in Virginia for many years and as a missionary revivalist, evangelist and guest speaker for over 24 years. Brian also serves in the nations as a part of Iris Global founded by missionaries Heidi and Rolland Baker and serves on the board of several nonprofit organizations. He and his wife Valerie both hold Masters degrees in Practical Theology from Regent University and currently reside in Williamsburg, VA.\n\nValerie Britton has a prophetic and teaching ministry and travels within the United States and internationally as a guest speaker. She brings a message of Father God's love, encouraging all believers to live like children of God.",
        ];

        foreach ($bios as $slug => $bio) {
            Speaker::query()->where('slug', $slug)->update(['bio' => $bio]);
        }
    }

    private function updateWorkshops(): void
    {
        $updates = [
            'power-evangelism' => [
                'title' => 'Power Evangelism - David Gava',
                'description' => 'Showing God\'s love and presence through His healing power, deliverance, prophetic words, and making the Gospel tangible by anticipating supernatural breakthrough, not merely through words but through the power of the Holy Spirit.',
            ],
            'revival-harvest' => [
                'title' => 'Revival Harvest - David Gava',
                'description' => "Do you have a passion to see the lost saved, ignited by Holy Spirit Fire?\n\nCome and be equipped for the harvest. The Holy Spirit wants to transform your life from ordinary to extraordinary, by allowing the supernatural reality of God's Heavenly Kingdom to pervade every area of your life.",
            ],
            'prophetic-arts' => [
                'title' => 'The Beautiful Heart of Jesus: Set Free Through Creative Movement - Dr. Kate Hartman',
                'description' => 'You are invited to join Dr. Kate Hartman for a transformative prophetic workshop focused on the Lord Jesus Christ, the Lover of your soul, the Healer of the brokenhearted, and the Restorer of shattered dreams. Experience His profound presence as you embark on a Holy Spirit-led journey of inner healing and newfound freedom through creative movement. Let go of the past and step into a glorious future filled with grace and hope as you encounter the beautiful heart of Jesus.',
            ],
            'prophetic-arts-sunday' => [
                'title' => 'The Beautiful Heart of Jesus: Set Free Through Creative Movement - Dr. Kate Hartman',
                'description' => 'You are invited to join Dr. Kate Hartman for a transformative prophetic workshop focused on the Lord Jesus Christ, the Lover of your soul, the Healer of the brokenhearted, and the Restorer of shattered dreams. Experience His profound presence as you embark on a Holy Spirit-led journey of inner healing and newfound freedom through creative movement. Let go of the past and step into a glorious future filled with grace and hope as you encounter the beautiful heart of Jesus.',
            ],
            'missions' => [
                'title' => 'Passion, Purpose, and Fire - Mary Pat Gokee',
                'description' => "Do you want more direction and purpose in your life? Do you want greater passion for God? Do you want to become a more serious follower of Jesus? Do you want more connection with the Holy Spirit? If so, this workshop is for you.\n\nLearn how to live an unoffendable life and walk in forgiveness. Learn how to go through spiritual battles and win as a son / daughter of King Jesus. You will be propelled into action for evangelism, receiving keys on how to see others supernaturally healed and delivered. You'll hear what a compassionate missional lifestyle looks like in your everyday life.\n\nYou are created to love God wholeheartedly and help others do the same. You were created for this. Join us on the Frontlines.",
            ],
            'missions-sunday' => [
                'title' => 'Passion, Purpose, and Fire - Mary Pat Gokee',
                'description' => "Do you want more direction and purpose in your life? Do you want greater passion for God? Do you want to become a more serious follower of Jesus? Do you want more connection with the Holy Spirit? If so, this workshop is for you.\n\nLearn how to live an unoffendable life and walk in forgiveness. Learn how to go through spiritual battles and win as a son / daughter of King Jesus. You will be propelled into action for evangelism, receiving keys on how to see others supernaturally healed and delivered. You'll hear what a compassionate missional lifestyle looks like in your everyday life.\n\nYou are created to love God wholeheartedly and help others do the same. You were created for this. Join us on the Frontlines.",
            ],
            'marketplace-missions' => [
                'title' => 'Marketplace Missions - Baoyan Lam & Rudy Taslim',
                'description' => "This workshop will awaken you to see the marketplace as one of the greatest mission fields of our time. Lam and Rudy Taslim come from strong marketplace and design backgrounds and have led humanitarian, development, and business initiatives around the world. Though they come from a small nation, they have seen how God's Kingdom principles carry power far beyond size—impacting hundreds and thousands of lives by rebuilding communities, restoring dignity, and bringing hope in both developing and developed nations.\n\nRooted in Isaiah 61, their vision is to rebuild, renew, and restore. Through real stories from war zones, vulnerable communities, and strategic global projects, you will discover how your work, influence, and resources can become tools for transformation. This session will help you see how business, innovation, and leadership can open doors, shape culture, and disciple nations.\n\nThis is more than a workshop. It is a call to live with purpose—to see your workplace as an altar, your work as worship, and your life as part of God's plan to bring healing, freedom, and restoration to the world.",
            ],
            'marketplace-missions-sunday' => [
                'title' => 'Marketplace Missions - Baoyan Lam & Rudy Taslim',
                'description' => "This workshop will awaken you to see the marketplace as one of the greatest mission fields of our time. Lam and Rudy Taslim come from strong marketplace and design backgrounds and have led humanitarian, development, and business initiatives around the world. Though they come from a small nation, they have seen how God's Kingdom principles carry power far beyond size—impacting hundreds and thousands of lives by rebuilding communities, restoring dignity, and bringing hope in both developing and developed nations.\n\nRooted in Isaiah 61, their vision is to rebuild, renew, and restore. Through real stories from war zones, vulnerable communities, and strategic global projects, you will discover how your work, influence, and resources can become tools for transformation. This session will help you see how business, innovation, and leadership can open doors, shape culture, and disciple nations.\n\nThis is more than a workshop. It is a call to live with purpose—to see your workplace as an altar, your work as worship, and your life as part of God's plan to bring healing, freedom, and restoration to the world.",
            ],
            'human-trafficking-awareness' => [
                'title' => 'Pioneering in Human Trafficking - Katey Maddux',
                'description' => "Human trafficking is not a single issue with a single solution—it is a complex reality that requires discernment, humility, and long-term faithfulness. Many people think trafficking only looks like kidnapping, chains, or people locked in rooms. While those cases do exist, much of trafficking happens quietly, involving fraud, coercion, or force, and operating through fear, dependency, vulnerability, and manipulation. It is often hidden in plain sight, within everyday systems and situations.\n\nIn this session, Katey Maddux shares from real, on-the-ground experience across multiple nations, offering a clear understanding of what it means to work in this space responsibly. The session highlights the realities of working across cultures, systems, and legal frameworks, as well as the importance of long-term presence, trust-building, and collaboration. It emphasizes spiritual discernment, humility, and obedience when navigating complexity, particularly when progress is slow, outcomes are unclear, and faithful presence matters more than immediate results.\n\nThis session is for those sensing a call to engage in trafficking prevention, intervention, advocacy, reform, partnership, or prayer, and who feel the weight and complexity of the assignment. If you are called to build where there is no roadmap, to stand in the gap with wisdom, and to steward a burden that feels bigger than you, this session will help you pioneer with clarity, integrity, and Kingdom authority.",
            ],
            'human-trafficking-awareness-sunday' => [
                'title' => 'Pioneering in Human Trafficking - Katey Maddux',
                'description' => "Human trafficking is not a single issue with a single solution—it is a complex reality that requires discernment, humility, and long-term faithfulness. Many people think trafficking only looks like kidnapping, chains, or people locked in rooms. While those cases do exist, much of trafficking happens quietly, involving fraud, coercion, or force, and operating through fear, dependency, vulnerability, and manipulation. It is often hidden in plain sight, within everyday systems and situations.\n\nIn this session, Katey Maddux shares from real, on-the-ground experience across multiple nations, offering a clear understanding of what it means to work in this space responsibly. The session highlights the realities of working across cultures, systems, and legal frameworks, as well as the importance of long-term presence, trust-building, and collaboration. It emphasizes spiritual discernment, humility, and obedience when navigating complexity, particularly when progress is slow, outcomes are unclear, and faithful presence matters more than immediate results.\n\nThis session is for those sensing a call to engage in trafficking prevention, intervention, advocacy, reform, partnership, or prayer, and who feel the weight and complexity of the assignment. If you are called to build where there is no roadmap, to stand in the gap with wisdom, and to steward a burden that feels bigger than you, this session will help you pioneer with clarity, integrity, and Kingdom authority.",
            ],
            'father-heart-of-god' => [
                'title' => 'The Burning Generation: Living Like Jesus - Brian & Valerie Britton',
                'description' => 'God is revealing Himself so powerfully in this generation. This workshop will explore how to practically live like Christ in these days of both chaos and awakening. Many hearts have been set aflame in this season, but how do we effectively carry that Fire into our lives and mission to see His Light and the knowledge of His Glory cover the earth.',
            ],
            'father-heart-of-god-sunday' => [
                'title' => 'The Burning Generation: Living Like Jesus - Brian & Valerie Britton',
                'description' => 'God is revealing Himself so powerfully in this generation. This workshop will explore how to practically live like Christ in these days of both chaos and awakening. Many hearts have been set aflame in this season, but how do we effectively carry that Fire into our lives and mission to see His Light and the knowledge of His Glory cover the earth.',
            ],
        ];

        foreach ($updates as $slug => $data) {
            Workshop::query()->where('slug', $slug)->update($data);
        }
    }
}
