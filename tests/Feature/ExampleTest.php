<?php

declare(strict_types=1);

use Tests\TestCase;

test('returns a successful response', function (): void {
    /** @var TestCase $this */
    $response = $this->get('/');

    $response->assertOk();
});
