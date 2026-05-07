<?php

declare(strict_types=1);

use App\Livewire\Pages\Home;
use App\Models\Faq;
use App\Models\Speaker;
use App\Models\Sponsor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    Speaker::query()->delete();
    Sponsor::query()->delete();
    Faq::query()->delete();
});

it('renders home page successfully', function () {
    $this->get('/')
        ->assertStatus(200)
        ->assertSeeLivewire(Home::class);
});

it('displays featured speakers from database', function () {
    $speaker = Speaker::factory()->featured()->speaker()->create([
        'name' => 'Test Speaker',
        'title' => 'Keynote',
        'organization' => 'Test Org',
    ]);

    Livewire::test(Home::class)
        ->assertSee('Test Speaker')
        ->assertSee('Keynote')
        ->assertSee('Test Org');
});

it('displays workshop leaders from database', function () {
    $workshopLeader = Speaker::factory()->create([
        'slug' => 'david-gava',
        'name' => 'Workshop Leader',
        'title' => 'Workshop Title',
        'organization' => 'Workshop Org',
        'type' => 'workshop_leader',
        'is_featured' => false,
    ]);

    Livewire::test(Home::class)
        ->assertSee('Workshop Leader');
});

it('displays main sponsor from database', function () {
    $mainSponsor = Sponsor::factory()->platinum()->create([
        'name' => 'Main Sponsor',
    ]);

    Livewire::test(Home::class)
        ->assertSee('Main Sponsor');
});

it('displays partner sponsors from database', function () {
    $partner = Sponsor::factory()->gold()->create([
        'name' => 'Gold Partner',
    ]);

    Livewire::test(Home::class)
        ->assertSee('Gold Partner');
});

it('displays faqs from database', function () {
    $faq = Faq::factory()->general()->create([
        'question' => 'What is the event about?',
        'answer' => 'This is a revival conference.',
    ]);

    Livewire::test(Home::class)
        ->assertSee('What is the event about?')
        ->assertSee('This is a revival conference.');
});

it('does not display unpublished faqs', function () {
    $unpublishedFaq = Faq::factory()->unpublished()->create([
        'question' => 'Hidden FAQ question',
        'answer' => 'Hidden FAQ answer',
    ]);

    Livewire::test(Home::class)
        ->assertDontSee('Hidden FAQ question');
});

it('does not display inactive sponsors', function () {
    $inactiveSponsor = Sponsor::factory()->inactive()->create([
        'name' => 'Inactive Sponsor',
    ]);

    Livewire::test(Home::class)
        ->assertDontSee('Inactive Sponsor');
});
