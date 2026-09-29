<?php

declare(strict_types=1);

use App\Models\User;
use Tests\TestCase;

test('confirm password screen can be rendered', function (): void {
    /** @var TestCase $this */
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('password.confirm'));

    $response->assertOk();
});
