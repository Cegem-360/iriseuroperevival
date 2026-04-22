<?php

declare(strict_types=1);

use App\Models\User;

beforeEach(function (): void {
    config()->set('internal_test.token', 'validtokenfixture123');
    config()->set('internal_test.amount_huf', 175);
    config()->set('internal_test.expires_at', null);
});

it('returns 404 when no token is configured', function (): void {
    config()->set('internal_test.token', null);

    $admin = User::factory()->create(['is_admin' => true]);

    $this->actingAs($admin)
        ->get('/register/__internal/anything')
        ->assertNotFound();
});

it('returns 404 for anonymous visitors even with correct token', function (): void {
    $this->get('/register/__internal/validtokenfixture123')
        ->assertNotFound();
});

it('returns 404 for authenticated non-admin users with correct token', function (): void {
    $user = User::factory()->create(['is_admin' => false]);

    $this->actingAs($user)
        ->get('/register/__internal/validtokenfixture123')
        ->assertNotFound();
});

it('returns 404 for admins with wrong token', function (): void {
    $admin = User::factory()->create(['is_admin' => true]);

    $this->actingAs($admin)
        ->get('/register/__internal/wrongtoken999')
        ->assertNotFound();
});

it('returns 404 when the expiry date has passed', function (): void {
    config()->set('internal_test.expires_at', now()->subDay()->toIso8601String());

    $admin = User::factory()->create(['is_admin' => true]);

    $this->actingAs($admin)
        ->get('/register/__internal/validtokenfixture123')
        ->assertNotFound();
});

it('allows an authenticated admin with the correct token', function (): void {
    $admin = User::factory()->create(['is_admin' => true]);

    $response = $this->actingAs($admin)
        ->get('/register/__internal/validtokenfixture123');

    $response->assertOk();
    $response->assertSee('Internal Test');
    expect($response->headers->get('X-Robots-Tag'))
        ->toContain('noindex')
        ->toContain('nofollow');
});

it('is not reachable from the public register route and does not mention the internal path', function (): void {
    $this->get('/register')
        ->assertOk()
        ->assertDontSee('Internal Test Mode')
        ->assertDontSee('__internal');
});
