<?php

declare(strict_types=1);

use App\Models\Faq;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Update venue FAQ (id 8) with actual venue details and move to position 2
        Faq::query()->where('id', 8)->update([
            'question' => 'Where is the conference held?',
            'answer' => "Europe Revival 2026 will be held at BOK Csarnok in Budapest, Hungary.\n\nAddress: Budapest, Dózsa György út 1, 1146",
            'sort_order' => 2,
        ]);

        // Shift existing FAQs down to make room (ids 2-7 → sort_order +1)
        Faq::query()->whereIn('id', [2, 3, 4, 5, 6, 7])->increment('sort_order');

        // 2. Rename Ministry Team FAQ → Volunteer
        Faq::query()->where('id', 6)->update([
            'question' => 'How do I apply to Volunteer?',
            'answer' => 'Volunteer applications are open! Complete our application form and tell us how you would like to serve. Approved volunteers receive a 20% discount on the ticket and a free event t-shirt. Applications close September 1, 2026.',
            'category' => 'volunteer',
        ]);

        // 3. Add "Where can I get answers?" FAQ (second-to-last)
        Faq::query()->create([
            'question' => 'Where can I get answers to my questions about the conference?',
            'answer' => 'If you can\'t find the answer on our website, please contact us by email at info@europerevival.org and we\'ll be happy to help.',
            'category' => 'general',
            'sort_order' => 9,
            'is_published' => true,
        ]);

        // 4. Add "How can I support Iris?" FAQ (last)
        Faq::query()->create([
            'question' => 'How can I support the work of Iris?',
            'answer' => 'If you would like to support the mission of Iris, you can find more information at iriskrakow.org. Your generosity helps bring light to the darkness, healing to the broken, and love to the unloved across Europe.',
            'category' => 'general',
            'sort_order' => 10,
            'is_published' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove added FAQs
        Faq::query()->where('question', 'Where can I get answers to my questions about the conference?')->delete();
        Faq::query()->where('question', 'How can I support the work of Iris?')->delete();

        // Restore Ministry Team FAQ
        Faq::query()->where('id', 6)->update([
            'question' => 'How do I apply for the Ministry Team?',
            'answer' => 'Ministry Team applications are open! You\'ll need to complete our application form including your testimony and pastor\'s reference. Approved team members receive free conference access in exchange for serving in healing rooms, prophetic ministry, or practical support. Applications close September 1, 2026.',
            'category' => 'registration',
        ]);

        // Restore venue FAQ
        Faq::query()->where('id', 8)->update([
            'question' => 'Where will the conference be held?',
            'answer' => 'Europe Revival 2026 will be held in Budapest, Hungary. The exact venue details and address will be announced soon. Stay tuned for updates!',
            'sort_order' => 8,
        ]);

        // Shift sort orders back
        Faq::query()->whereIn('id', [2, 3, 4, 5, 6, 7])->decrement('sort_order');
    }
};
