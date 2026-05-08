<?php

declare(strict_types=1);

use App\Models\Faq;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration
{
    public function up(): void
    {
        $faqs = [
            [
                'question' => 'How should I arrange accommodation?',
                'answer' => "The event will take place at BOK Sportcsarnok (1146 Budapest, Dózsa György út 1), so we recommend booking accommodation nearby or in a location with convenient access to public transport.\n\nDue to the scale of the event with several thousand participants, we are unable to provide accommodation for the ministry team. However, we have included a list of recommended places to stay in the area.\n\nList of recommended accommodation will be published soon!",
                'sort_order' => 1,
            ],
            [
                'question' => 'Is food provided?',
                'answer' => 'Meals are not included in the registration. There are many restaurants available in the area. (Between 5–10 euros)',
                'sort_order' => 2,
            ],
            [
                'question' => 'How do I get to the venue?',
                'answer' => "Budapest is easily accessible by plane, train, and bus.\n\n- From the airport: take bus 100E to Deák Ferenc Square (~30 minutes)\n- Metro and tram lines are available near the venue\n- Parking is limited – public transport is recommended\n\nWe also suggest using [Uber](https://www.uber.com/global/en/cities/budapest/) or [Bolt](https://bolt.eu/en/cities/budapest/).",
                'sort_order' => 3,
            ],
            [
                'question' => 'How does the application process work?',
                'answer' => "- Fill out the online application form\n- We will contact your pastor for a reference\n- We review your application\n- You will be notified of the decision via email",
                'sort_order' => 4,
            ],
            [
                'question' => 'Why is a pastoral reference required?',
                'answer' => "A pastoral reference ensures that Ministry Team members are active, committed members of a local church.\n\nYour pastor confirms:\n\n- Your church affiliation\n- The practice of your faith in your daily life\n- Your suitability for ministry",
                'sort_order' => 5,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::query()->updateOrCreate(
                ['question' => $faq['question']],
                array_merge($faq, [
                    'category' => 'ministry',
                    'is_published' => true,
                ]),
            );
        }
    }

    public function down(): void
    {
        Faq::query()
            ->where('category', 'ministry')
            ->whereIn('question', [
                'How should I arrange accommodation?',
                'Is food provided?',
                'How do I get to the venue?',
                'How does the application process work?',
                'Why is a pastoral reference required?',
            ])
            ->delete();
    }
};
