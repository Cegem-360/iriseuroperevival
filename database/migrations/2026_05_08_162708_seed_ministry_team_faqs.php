<?php

declare(strict_types=1);

use App\Models\Faq;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration
{
    public function up(): void
    {
        // Stored as HTML so the Filament RichEditor in the admin can edit them directly.
        $faqs = [
            [
                'question' => 'How should I arrange accommodation?',
                'answer' => '<p>The event will take place at BOK Sportcsarnok (1146 Budapest, Dózsa György út 1), so we recommend booking accommodation nearby or in a location with convenient access to public transport.</p><p>Due to the scale of the event with several thousand participants, we are unable to provide accommodation for the ministry team. However, we have included a list of recommended places to stay in the area.</p><p><strong>List of recommended accommodation will be published soon!</strong></p>',
                'sort_order' => 1,
            ],
            [
                'question' => 'Is food provided?',
                'answer' => '<p>Meals are not included in the registration. There are many restaurants available in the area. (Between 5–10 euros)</p>',
                'sort_order' => 2,
            ],
            [
                'question' => 'How do I get to the venue?',
                'answer' => '<p>Budapest is easily accessible by plane, train, and bus.</p><ul><li>From the airport: take bus 100E to Deák Ferenc Square (~30 minutes)</li><li>Metro and tram lines are available near the venue</li><li>Parking is limited – public transport is recommended</li></ul><p>We also suggest using <a href="https://www.uber.com/global/en/cities/budapest/" target="_blank" rel="noopener">Uber</a> or <a href="https://bolt.eu/en/cities/budapest/" target="_blank" rel="noopener">Bolt</a>.</p>',
                'sort_order' => 3,
            ],
            [
                'question' => 'How does the application process work?',
                'answer' => '<ul><li>Fill out the online application form</li><li>We will contact your pastor for a reference</li><li>We review your application</li><li>You will be notified of the decision via email</li></ul>',
                'sort_order' => 4,
            ],
            [
                'question' => 'Why is a pastoral reference required?',
                'answer' => '<p>A pastoral reference ensures that Ministry Team members are active, committed members of a local church.</p><p>Your pastor confirms:</p><ul><li>Your church affiliation</li><li>The practice of your faith in your daily life</li><li>Your suitability for ministry</li></ul>',
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
