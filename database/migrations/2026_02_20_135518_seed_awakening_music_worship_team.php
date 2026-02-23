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
        Speaker::query()->create([
            'name' => 'Awakening Music',
            'title' => 'Worship Team',
            'type' => 'worship_team',
            'is_featured' => false,
            'sort_order' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Speaker::query()->where('slug', 'awakening-music')->delete();
    }
};
