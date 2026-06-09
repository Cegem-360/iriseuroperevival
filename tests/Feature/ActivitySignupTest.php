<?php

declare(strict_types=1);

use App\Livewire\ActivitySignupForm;
use App\Livewire\Pages\ActivitySignup;
use App\Models\ActivitySignup as ActivitySignupModel;
use App\Models\Workshop;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

describe('activity signup pages', function () {
    it('renders the workshop signup page', function () {
        $this->get('/signup/workshops')
            ->assertStatus(200)
            ->assertSeeLivewire(ActivitySignup::class);
    });

    it('renders the healing rooms signup page', function () {
        $this->get('/signup/healing-rooms')
            ->assertStatus(200)
            ->assertSeeLivewire(ActivitySignup::class);
    });

    it('renders the prophetic rooms signup page', function () {
        $this->get('/signup/prophetic-rooms')
            ->assertStatus(200)
            ->assertSeeLivewire(ActivitySignup::class);
    });

    it('renders the street evangelism signup page', function () {
        $this->get('/signup/street-evangelism')
            ->assertStatus(200)
            ->assertSeeLivewire(ActivitySignup::class);
    });

    it('shows correct title for each activity type', function () {
        Livewire::test(ActivitySignup::class, ['activity' => 'workshop'])
            ->assertSee('Workshops');

        Livewire::test(ActivitySignup::class, ['activity' => 'healing_room'])
            ->assertSee('Healing Rooms');

        Livewire::test(ActivitySignup::class, ['activity' => 'prophetic_room'])
            ->assertSee('Prophetic Rooms');

        Livewire::test(ActivitySignup::class, ['activity' => 'street_evangelism'])
            ->assertSee('Street Evangelism');
    });
});

describe('activity signup form', function () {
    it('submits a signup successfully', function () {
        Livewire::test(ActivitySignupForm::class, ['activityType' => 'healing_room'])
            ->set('firstName', 'John')
            ->set('lastName', 'Doe')
            ->set('email', 'john@example.com')
            ->set('phone', '+36 30 123 4567')
            ->set('notes', 'Looking forward to it')
            ->call('submit')
            ->assertSet('submitted', true);

        $this->assertDatabaseHas('activity_signups', [
            'activity_type' => 'healing_room',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone' => '+36 30 123 4567',
            'notes' => 'Looking forward to it',
        ]);
    });

    it('generates a uuid on creation', function () {
        Livewire::test(ActivitySignupForm::class, ['activityType' => 'street_evangelism'])
            ->set('firstName', 'Jane')
            ->set('lastName', 'Smith')
            ->set('email', 'jane@example.com')
            ->call('submit');

        $signup = ActivitySignupModel::query()->first();
        expect($signup->uuid)->not->toBeNull();
    });

    it('validates required fields', function () {
        Livewire::test(ActivitySignupForm::class, ['activityType' => 'healing_room'])
            ->call('submit')
            ->assertHasErrors(['firstName', 'lastName', 'email']);
    });

    it('validates email format', function () {
        Livewire::test(ActivitySignupForm::class, ['activityType' => 'healing_room'])
            ->set('firstName', 'John')
            ->set('lastName', 'Doe')
            ->set('email', 'not-an-email')
            ->call('submit')
            ->assertHasErrors(['email']);
    });

    it('allows optional phone and notes', function () {
        Livewire::test(ActivitySignupForm::class, ['activityType' => 'prophetic_room'])
            ->set('firstName', 'John')
            ->set('lastName', 'Doe')
            ->set('email', 'john@example.com')
            ->call('submit')
            ->assertSet('submitted', true)
            ->assertHasNoErrors();
    });

    it('shows workshop select for workshop type', function () {
        Workshop::factory()->create(['title' => 'Prophetic Arts']);

        Livewire::test(ActivitySignupForm::class, ['activityType' => 'workshop'])
            ->assertSee('Select Workshop')
            ->assertSee('Prophetic Arts');
    });

    it('does not show workshop select for non-workshop types', function () {
        Livewire::test(ActivitySignupForm::class, ['activityType' => 'healing_room'])
            ->assertDontSee('Select Workshop');
    });

    it('saves workshop_id when signing up for a workshop', function () {
        $workshop = Workshop::factory()->create(['title' => 'Prayer Workshop']);

        Livewire::test(ActivitySignupForm::class, ['activityType' => 'workshop'])
            ->set('workshopId', $workshop->id)
            ->set('firstName', 'John')
            ->set('lastName', 'Doe')
            ->set('email', 'john@example.com')
            ->call('submit')
            ->assertSet('submitted', true);

        $this->assertDatabaseHas('activity_signups', [
            'activity_type' => 'workshop',
            'workshop_id' => $workshop->id,
        ]);
    });

    it('shows success message after submission', function () {
        Livewire::test(ActivitySignupForm::class, ['activityType' => 'healing_room'])
            ->set('firstName', 'John')
            ->set('lastName', 'Doe')
            ->set('email', 'john@example.com')
            ->call('submit')
            ->assertSee('You\'re signed up!', escape: false);
    });
});
