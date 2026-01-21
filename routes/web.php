<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\WebhookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home & Landing Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/program', [HomeController::class, 'program'])->name('program');
Route::get('/workshops', [HomeController::class, 'workshops'])->name('workshops');
Route::get('/speakers', [HomeController::class, 'speakers'])->name('speakers');
Route::get('/speakers/{slug}', [HomeController::class, 'speaker'])->name('speaker.show');

// Registration Routes
Route::prefix('register')->group(function () {
    // Attendee Registration (default)
    Route::get('/', [RegistrationController::class, 'attendee'])->name('register');
    
    // Ministry Team Application
    Route::get('/ministry', [RegistrationController::class, 'ministry'])->name('register.ministry');
    
    // Volunteer Application
    Route::get('/volunteer', [RegistrationController::class, 'volunteer'])->name('volunteer');
    
    // Success & Cancel Pages
    Route::get('/success/{uuid}', [RegistrationController::class, 'success'])->name('register.success');
    Route::get('/cancel/{uuid}', [RegistrationController::class, 'cancel'])->name('register.cancel');
});

// Stripe Webhook
Route::post('/webhooks/stripe', [WebhookController::class, 'handleStripe'])
    ->name('webhooks.stripe')
    ->withoutMiddleware(['web', 'csrf']);

// Newsletter Subscription
Route::post('/newsletter/subscribe', [HomeController::class, 'subscribeNewsletter'])
    ->name('newsletter.subscribe');

// Static Pages
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');

// Language Switching
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'hu', 'de'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    // Registrations Management
    Route::get('/registrations', function () {
        return view('admin.registrations.index');
    })->name('admin.registrations');
    
    Route::get('/registrations/{uuid}', function ($uuid) {
        return view('admin.registrations.show', compact('uuid'));
    })->name('admin.registrations.show');
    
    // Speakers Management
    Route::resource('speakers', \App\Http\Controllers\Admin\SpeakerController::class)
        ->names('admin.speakers');
    
    // Sponsors Management  
    Route::resource('sponsors', \App\Http\Controllers\Admin\SponsorController::class)
        ->names('admin.sponsors');
    
    // FAQs Management
    Route::resource('faqs', \App\Http\Controllers\Admin\FaqController::class)
        ->names('admin.faqs');
});
