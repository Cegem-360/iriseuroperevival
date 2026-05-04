<?php

declare(strict_types=1);

use App\Models\Speaker;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration
{
    public function up(): void
    {
        Speaker::query()
            ->where('slug', 'awakening-music')
            ->update(['photo_path' => 'images/alt-style/awakening-worship.webp']);

        Speaker::query()->updateOrCreate(
            ['slug' => 'mountain-people-worship'],
            [
                'name' => 'Mountain People Worship',
                'title' => 'Worship Team',
                'type' => 'worship_team',
                'is_featured' => false,
                'sort_order' => 2,
                'photo_path' => 'images/alt-style/mountain-people.webp',
            ],
        );

        Speaker::query()->updateOrCreate(
            ['slug' => 'iris-europe-worship'],
            [
                'name' => 'Iris Europe Worship',
                'title' => 'Worship Team',
                'type' => 'worship_team',
                'is_featured' => false,
                'sort_order' => 3,
                'photo_path' => 'images/alt-style/iris-europe-worship.webp',
            ],
        );
    }

    public function down(): void
    {
        Speaker::query()
            ->whereIn('slug', ['mountain-people-worship', 'iris-europe-worship'])
            ->delete();
    }
};
