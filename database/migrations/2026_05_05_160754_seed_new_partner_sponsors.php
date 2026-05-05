<?php

declare(strict_types=1);

use App\Models\Sponsor;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration
{
    public function up(): void
    {
        $partners = [
            ['name' => 'Awakening', 'logo_path' => 'resources/images/partner-logos/awakening.webp'],
            ['name' => 'Iris Lisbon', 'logo_path' => 'resources/images/partner-logos/iris-lisbon.webp'],
            ['name' => 'Iris UK', 'logo_path' => 'resources/images/partner-logos/iris-uk.webp'],
            ['name' => 'Pray California', 'logo_path' => 'resources/images/partner-logos/pray-california.webp'],
            ['name' => 'Harvest', 'logo_path' => 'resources/images/partner-logos/harvest.webp'],
        ];

        foreach ($partners as $i => $partner) {
            Sponsor::query()->updateOrCreate(
                ['name' => $partner['name']],
                array_merge($partner, [
                    'tier' => 'gold',
                    'is_active' => true,
                    'sort_order' => 10 + $i,
                ]),
            );
        }
    }

    public function down(): void
    {
        Sponsor::query()
            ->whereIn('name', ['Awakening', 'Iris Lisbon', 'Iris UK', 'Pray California', 'Harvest'])
            ->delete();
    }
};
