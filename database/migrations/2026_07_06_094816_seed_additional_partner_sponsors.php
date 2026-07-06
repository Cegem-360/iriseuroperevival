<?php

declare(strict_types=1);

use App\Models\Sponsor;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $partners = [
            ['name' => 'Pray Migori', 'logo_path' => 'resources/images/partner-logos/pray-migori.webp'],
            ['name' => 'Pray Pakistan', 'logo_path' => 'resources/images/partner-logos/pray-pakistan.webp'],
            ['name' => 'Pray India', 'logo_path' => 'resources/images/partner-logos/pray-india.webp'],
            ['name' => 'Pray Sri Lanka', 'logo_path' => 'resources/images/partner-logos/pray-sri-lanka.webp'],
            ['name' => 'Freedom Christian University', 'logo_path' => 'resources/images/partner-logos/freedom-christian-university.webp'],
        ];

        foreach ($partners as $i => $partner) {
            Sponsor::query()->updateOrCreate(
                ['name' => $partner['name']],
                array_merge($partner, [
                    'tier' => 'gold',
                    'is_active' => true,
                    'sort_order' => 20 + $i,
                ]),
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Sponsor::query()
            ->whereIn('name', ['Pray Migori', 'Pray Pakistan', 'Pray India', 'Pray Sri Lanka', 'Freedom Christian University'])
            ->delete();
    }
};
