<?php

declare(strict_types=1);

use App\Models\Speaker;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration
{
    public function up(): void
    {
        Speaker::query()
            ->where('slug', 'baoyan-lam')
            ->update(['name' => 'Baoyan Lam & Rudy Taslim']);

        Speaker::query()->updateOrCreate(
            ['slug' => 'fernando-sousa'],
            [
                'name' => 'Fernando Sousa',
                'title' => 'Workshop Leader',
                'organization' => null,
                'country' => null,
                'bio' => null,
                'type' => 'workshop_leader',
                'is_featured' => false,
                'sort_order' => 14,
                'photo_path' => 'images/alt-style/workshop-leaders/sousa.webp',
            ],
        );

        Speaker::query()->updateOrCreate(
            ['slug' => 'iris-global-leaders'],
            [
                'name' => 'Iris Global leaders',
                'title' => 'Workshop Leaders',
                'organization' => null,
                'country' => null,
                'bio' => null,
                'type' => 'workshop_leader',
                'is_featured' => false,
                'sort_order' => 15,
                'photo_path' => 'images/alt-style/workshop-leaders/alumni.webp',
            ],
        );
    }

    public function down(): void
    {
        Speaker::query()
            ->whereIn('slug', ['fernando-sousa', 'iris-global-leaders'])
            ->delete();
    }
};
