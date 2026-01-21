<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    /**
     * Display the attendee registration form.
     */
    public function attendee(): View
    {
        return view('pages.register', [
            'type' => 'attendee',
            'title' => 'Register for Europe Revival 2026',
            'subtitle' => 'Secure your spot at the conference',
        ]);
    }

    /**
     * Display the ministry team application form.
     */
    public function ministry(): View
    {
        return view('pages.register', [
            'type' => 'ministry',
            'title' => 'Ministry Team Application',
            'subtitle' => 'Apply to serve at Europe Revival 2026',
        ]);
    }

    /**
     * Display the volunteer application form.
     */
    public function volunteer(): View
    {
        return view('pages.register', [
            'type' => 'volunteer',
            'title' => 'Volunteer Application',
            'subtitle' => 'Join us as a volunteer at Europe Revival 2026',
        ]);
    }

    /**
     * Display the success page after registration.
     */
    public function success(Request $request, string $uuid): View
    {
        $registration = Registration::where('uuid', $uuid)->firstOrFail();

        // If coming from Stripe, verify the payment
        if ($request->has('session_id')) {
            $stripeService = app(StripeService::class);
            $session = $stripeService->retrieveSession($request->session_id);
            
            if ($session->payment_status === 'paid' && !$registration->is_paid) {
                $registration->markAsPaid($session->payment_intent);
            }
        }

        return view('pages.register-success', compact('registration'));
    }

    /**
     * Display the cancellation page.
     */
    public function cancel(string $uuid): View
    {
        $registration = Registration::where('uuid', $uuid)->firstOrFail();

        return view('pages.register-cancel', compact('registration'));
    }
}
