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
        $workshopLeaders = Speaker::query()
            ->where('type', 'workshop_leader')
            ->get();

        $workshops = [
            [
                'title' => 'Prophetic Art & Worship',
                'short_description' => 'Discover how to express your worship through various art forms and prophetic creativity.',
                'description' => 'In this hands-on workshop, you will learn to tap into the creative flow of the Holy Spirit. We will explore painting, drawing, and other visual arts as expressions of worship and prophetic revelation.',
                'benefits' => [
                    'Learn to hear God through creative expression',
                    'Develop your prophetic art skills',
                    'Create art that ministers to others',
                    'Connect worship and creativity',
                ],
                'duration_minutes' => 120,
                'difficulty_level' => 'all',
                'capacity' => 30,
                'requirements' => ['Art supplies provided', 'Wear comfortable clothes'],
                'sort_order' => 1,
            ],
            [
                'title' => 'Intercession & Prayer Strategies',
                'short_description' => 'Learn powerful prayer strategies for personal and corporate intercession.',
                'description' => 'This workshop equips you with biblical foundations and practical tools for effective intercession. You will learn different prayer models and how to pray with authority.',
                'benefits' => [
                    'Understand biblical foundations of intercession',
                    'Learn strategic prayer models',
                    'Develop a consistent prayer life',
                    'Pray with greater authority and confidence',
                ],
                'duration_minutes' => 90,
                'difficulty_level' => 'intermediate',
                'capacity' => 50,
                'requirements' => ['Bible', 'Notebook'],
                'sort_order' => 2,
            ],
            [
                'title' => 'Youth Ministry Leadership',
                'short_description' => 'Equipping the next generation of youth leaders with practical tools and vision.',
                'description' => 'A comprehensive workshop designed for those called to minister to young people. Learn effective communication, program development, and discipleship strategies for youth ministry.',
                'benefits' => [
                    'Understand youth culture and communication',
                    'Develop engaging youth programs',
                    'Build effective discipleship pathways',
                    'Lead with vision and purpose',
                ],
                'duration_minutes' => 120,
                'difficulty_level' => 'beginner',
                'capacity' => 40,
                'requirements' => ['Open heart for youth ministry'],
                'sort_order' => 3,
            ],
            [
                'title' => 'Healing & Deliverance Ministry',
                'short_description' => 'Biblical principles and practical application for healing and deliverance ministry.',
                'description' => 'This intensive workshop covers the biblical basis for healing and deliverance, identifying spiritual bondages, and ministering freedom in Jesus name.',
                'benefits' => [
                    'Understand spiritual warfare principles',
                    'Learn to minister healing prayer',
                    'Recognize and break spiritual bondages',
                    'Walk in greater authority',
                ],
                'duration_minutes' => 150,
                'difficulty_level' => 'advanced',
                'capacity' => 25,
                'requirements' => ['Prior ministry experience recommended'],
                'sort_order' => 4,
            ],
            [
                'title' => 'Worship Team Development',
                'short_description' => 'Building and leading effective worship teams that usher in God\'s presence.',
                'description' => 'Whether you are a worship leader or team member, this workshop will help you develop musically and spiritually. We cover team dynamics, song selection, and cultivating an atmosphere of worship.',
                'benefits' => [
                    'Improve team dynamics and communication',
                    'Learn effective rehearsal techniques',
                    'Develop sensitivity to the Holy Spirit',
                    'Build a worship culture in your church',
                ],
                'duration_minutes' => 120,
                'difficulty_level' => 'intermediate',
                'capacity' => 35,
                'requirements' => ['Musicians welcome', 'Bring your instrument if desired'],
                'sort_order' => 5,
            ],
        ];

        foreach ($workshops as $index => $workshopData) {
            $speaker = $workshopLeaders->get($index % $workshopLeaders->count());

            Workshop::create([
                ...$workshopData,
                'speaker_id' => $speaker?->id,
            ]);
        }
    }
}
