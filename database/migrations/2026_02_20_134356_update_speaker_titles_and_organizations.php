<?php

declare(strict_types=1);

use App\Models\Speaker;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $updates = [
            'mel-tari' => [
                'title' => 'Guest Speaker',
                'organization' => 'Evangelist, author Like a Mighty Wind',
            ],
            'heidi-baker' => [
                'title' => 'Guest Speaker',
                'organization' => 'Missionary, co-founder Iris Global',
            ],
            'david-gava' => [
                'title' => 'Guest Speaker',
                'organization' => 'Missionary, co-founder Kerusso',
            ],
            'mary-pat-gokee' => [
                'title' => 'Workshop Leader',
                'organization' => 'Pastor, Frontlines Ministries International',
            ],
            'baoyan-lam' => [
                'name' => 'Baoyan Lam & Rudy Taslim',
                'title' => 'Workshop Leader',
                'organization' => 'Founders Iris Singapore & Living Oaks',
            ],
        ];

        foreach ($updates as $slug => $data) {
            Speaker::query()->where('slug', $slug)->update($data);
        }

        // Update any remaining "Speaker" or "Keynote Speaker" or "Special Guest" titles to "Guest Speaker"
        Speaker::query()
            ->whereIn('title', ['Speaker', 'Keynote Speaker', 'Special Guest'])
            ->update(['title' => 'Guest Speaker']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $rollback = [
            'mel-tari' => [
                'title' => 'Special Guest',
                'organization' => 'Author, Like a Mighty Wind',
            ],
            'heidi-baker' => [
                'title' => 'Keynote Speaker',
                'organization' => 'Co-founder, Iris Global',
            ],
            'david-gava' => [
                'title' => 'Speaker',
                'organization' => 'Missionary / Founder, Kerusso Ministry',
            ],
            'mary-pat-gokee' => [
                'title' => 'Workshop Leader',
                'organization' => 'Prophetic Arts, Iris Global',
            ],
            'baoyan-lam' => [
                'name' => 'Baoyan Lam',
                'title' => 'Workshop Leader',
                'organization' => 'Family & Parenting, Iris Asia',
            ],
        ];

        foreach ($rollback as $slug => $data) {
            Speaker::query()->where('slug', $slug)->update($data);
        }

        Speaker::query()->where('slug', 'pastor-josef')->update(['title' => 'Speaker']);
    }
};
