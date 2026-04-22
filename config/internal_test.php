<?php

declare(strict_types=1);

return [
    'token' => env('INTERNAL_TEST_TOKEN'),

    'amount_huf' => (int) env('INTERNAL_TEST_AMOUNT_HUF', 175),

    'expires_at' => env('INTERNAL_TEST_EXPIRES_AT'),
];
