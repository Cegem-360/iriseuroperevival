<?php

declare(strict_types=1);

use App\Http\Controllers\WebhookController;
use App\Http\Middleware\EnsureInternalTestAccess;
use App\Livewire\Pages\ActivitySignup;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\MinistryTeam;
use App\Livewire\Pages\Privacy;
use App\Livewire\Pages\Program;
use App\Livewire\Pages\Register;
use App\Livewire\Pages\RegisterCancel;
use App\Livewire\Pages\RegisterInternalTest;
use App\Livewire\Pages\RegisterSuccess;
use App\Livewire\Pages\Shop\Cart as ShopCart;
use App\Livewire\Pages\Shop\Checkout as ShopCheckout;
use App\Livewire\Pages\Shop\Index as ShopIndex;
use App\Livewire\Pages\Shop\Success as ShopSuccess;
use App\Livewire\Pages\Speakers;
use App\Livewire\Pages\SpeakerShow;
use App\Livewire\Pages\Terms;
use App\Livewire\Pages\Workshops;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home & Landing Pages
Route::get('/', Home::class)->name('home');
Route::get('/program', Program::class)->name('program');
Route::get('/workshops', Workshops::class)->name('workshops');
Route::get('/speakers', Speakers::class)->name('speakers');
Route::get('/speakers/{slug}', SpeakerShow::class)->name('speaker.show');
Route::get('/ministry-team', MinistryTeam::class)->name('ministry-team');

// Registration Routes
Route::prefix('register')->group(function (): void {
    // Attendee Registration (default)
    Route::get('/', Register::class)->name('register');

    // Volunteer Application
    Route::get('/volunteer', Register::class)
        ->defaults('type', 'volunteer')
        ->name('volunteer');

    // Internal end-to-end live-payment test (admin-only, secret-token-gated, hidden).
    // Returns 404 unless the requester is an authenticated admin AND the URL token
    // matches config('internal_test.token'). Uses a separate, disposable Livewire
    // component pair so the production registration flow is untouched. Rollback =
    // delete these 4 files + this route block + migration rollback.
    Route::get('/__internal/{secret}', RegisterInternalTest::class)
        ->middleware(EnsureInternalTestAccess::class)
        ->where('secret', '[A-Za-z0-9]+')
        ->name('register.internal-test');

    // Success & Cancel Pages
    Route::get('/success/{uuid}', RegisterSuccess::class)->name('register.success');
    Route::get('/cancel/{uuid}', RegisterCancel::class)->name('register.cancel');
});

// Stripe Webhook
Route::post('/webhooks/stripe', [WebhookController::class, 'handleStripe'])
    ->name('webhooks.stripe')
    ->withoutMiddleware(['web', 'csrf']);

// Shop Routes
Route::prefix('shop')->group(function (): void {
    Route::get('/', ShopIndex::class)->name('shop.index');
    Route::get('/cart', ShopCart::class)->name('shop.cart');
    Route::get('/checkout', ShopCheckout::class)->name('shop.checkout');
    Route::get('/order/{uuid}/success', ShopSuccess::class)->name('shop.success');
});

// Activity Sign-Ups
Route::prefix('signup')->group(function (): void {
    Route::get('/workshops', ActivitySignup::class)->defaults('activity', 'workshop')->name('signup.workshops');
    Route::get('/healing-rooms', ActivitySignup::class)->defaults('activity', 'healing_room')->name('signup.healing-rooms');
    Route::get('/prophetic-rooms', ActivitySignup::class)->defaults('activity', 'prophetic_room')->name('signup.prophetic-rooms');
    Route::get('/street-evangelism', ActivitySignup::class)->defaults('activity', 'street_evangelism')->name('signup.street-evangelism');
});

// Newsletter Subscription
Route::post('/newsletter/subscribe', function () {
    request()->validate(['email' => ['required', 'email', 'max:255']]);

    // TODO: Add NewsletterSubscriber model when ready
    return back()->with('success', 'Thank you for subscribing!');
})->name('newsletter.subscribe');

// Static Pages
Route::get('/privacy', Privacy::class)->name('privacy');
Route::get('/terms', Terms::class)->name('terms');

// Language Switching
Route::get('/lang/{locale}', function ($locale): RedirectResponse {
    if (in_array($locale, ['en', 'hu', 'de'])) {
        session(['locale' => $locale]);
    }

    return back();
})->name('lang.switch');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::prefix('settings')->group(function (): void {
        Route::get('/profile', Profile::class)->name('profile.edit');
        Route::get('/password', Password::class)->name('user-password.edit');
        Route::get('/appearance', Appearance::class)->name('appearance.edit');
    });
});

Route::middleware(['auth', 'password.confirm'])->group(function (): void {
    Route::get('/two-factor', TwoFactor::class)->name('two-factor.show');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected) - TODO: implement admin middleware and controllers
|--------------------------------------------------------------------------
*/
// Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
//     Route::get('/', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard');
// });
