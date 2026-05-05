<?php

declare(strict_types=1);

use App\Models\ScheduleItem;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration
{
    public function up(): void
    {
        ScheduleItem::query()
            ->where('title', 'Street Evangelism')
            ->where('location', 'City Center')
            ->update(['location' => 'Belváros']);
    }

    public function down(): void
    {
        ScheduleItem::query()
            ->where('title', 'Street Evangelism')
            ->where('location', 'Belváros')
            ->update(['location' => 'City Center']);
    }
};
