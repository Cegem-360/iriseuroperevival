<?php

declare(strict_types=1);

use App\Models\Speaker;

test('photo_url returns null when no photo path is set', function (): void {
    $speaker = Speaker::factory()->make(['photo_path' => null]);

    expect($speaker->photo_url)->toBeNull();
});

test('photo_url returns a Storage URL for Filament-uploaded paths', function (): void {
    $speaker = Speaker::factory()->make([
        'photo_path' => 'speakers/01KQEQW52YBDBKSVPGG0QMSAMJ.jpg',
    ]);

    expect($speaker->photo_url)->toContain('/storage/speakers/01KQEQW52YBDBKSVPGG0QMSAMJ.jpg');
});

test('photo_url returns a Vite asset URL for legacy seeded image paths', function (): void {
    $speaker = Speaker::factory()->make([
        'photo_path' => 'images/speakers/heidi-baker.webp',
    ]);

    expect($speaker->photo_url)->toBeString()
        ->and($speaker->photo_url)->not->toContain('/storage/');
});
