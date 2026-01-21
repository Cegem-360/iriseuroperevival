<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use App\Models\Sponsor;
use App\Models\Faq;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index(): View
    {
        $speakers = Speaker::where('is_active', true)
            ->orderBy('order')
            ->limit(8)
            ->get();
            
        $sponsors = Sponsor::where('is_active', true)
            ->orderBy('tier')
            ->orderBy('order')
            ->get()
            ->groupBy('tier');
            
        $faqs = Faq::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('home', compact('speakers', 'sponsors', 'faqs'));
    }

    /**
     * Display the full program/schedule page.
     */
    public function program(): View
    {
        return view('pages.program');
    }

    /**
     * Display the workshops page.
     */
    public function workshops(): View
    {
        $workshopLeaders = Speaker::where('is_workshop_leader', true)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('pages.workshops', compact('workshopLeaders'));
    }

    /**
     * Display all speakers.
     */
    public function speakers(): View
    {
        $mainSpeakers = Speaker::where('is_main', true)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
            
        $workshopLeaders = Speaker::where('is_workshop_leader', true)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('pages.speakers', compact('mainSpeakers', 'workshopLeaders'));
    }

    /**
     * Display a single speaker.
     */
    public function speaker(string $slug): View
    {
        $speaker = Speaker::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('pages.speaker', compact('speaker'));
    }

    /**
     * Subscribe to newsletter.
     */
    public function subscribeNewsletter(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        NewsletterSubscriber::updateOrCreate(
            ['email' => $validated['email']],
            ['subscribed_at' => now()]
        );

        return back()->with('success', 'Thank you for subscribing!');
    }

    /**
     * Display the privacy policy.
     */
    public function privacy(): View
    {
        return view('pages.privacy');
    }

    /**
     * Display the terms of service.
     */
    public function terms(): View
    {
        return view('pages.terms');
    }
}
