<?php

declare(strict_types=1);

use Tests\TestCase;

test('registration screen can be rendered', function (): void {
    /** @var TestCase $this */
    $response = $this->get(route('register'));

    $response->assertOk();
});

test('new users can register', function (): void {
    /** @var TestCase $this */
    $response = $this->post(route('register.store'), [
        'name' => 'John Doe',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertSessionHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});
