<?php

declare(strict_types=1);

use App\Models\Faq;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration
{
    public function up(): void
    {
        Faq::query()->updateOrCreate(
            ['question' => 'Where will the one-day training take place?'],
            [
                'answer' => '<p>The training location will be sent by email to those whose applications have been accepted.</p>',
                'category' => 'ministry',
                'is_published' => true,
                'sort_order' => 0,
            ],
        );
    }

    public function down(): void
    {
        Faq::query()
            ->where('category', 'ministry')
            ->where('question', 'Where will the one-day training take place?')
            ->delete();
    }
};
