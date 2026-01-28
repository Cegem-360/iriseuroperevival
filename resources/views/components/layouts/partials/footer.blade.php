{{-- resources/views/components/footer.blade.php --}}
<footer class="bg-black border-t border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid md:grid-cols-4 gap-12">
            {{-- Logo & Description --}}
            <div class="md:col-span-2">
                <a href="{{ route('home') }}" class="inline-block mb-6">
                    <img src="{{ asset('images/iris-global-logo-white.svg') }}" alt="Iris Global" class="h-8">
                </a>
                <p class="text-white/50 text-sm leading-relaxed max-w-md mb-6">
                    Europe Revival 2026 is brought to you by Iris Global, a ministry dedicated to bringing 
                    the love of Jesus to the nations through revival, healing, and supernatural encounters.
                </p>
                {{-- Social Links --}}
                <div class="flex items-center gap-4">
                    <a href="mailto:info@europerevival.org" class="w-10 h-10 bg-navy-800 hover:bg-navy-700 rounded-full flex items-center justify-center text-white/60 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </a>
                    <a href="https://facebook.com/europerevival" target="_blank" class="w-10 h-10 bg-navy-800 hover:bg-navy-700 rounded-full flex items-center justify-center text-white/60 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
                        </svg>
                    </a>
                    <a href="https://instagram.com/europerevival" target="_blank" class="w-10 h-10 bg-navy-800 hover:bg-navy-700 rounded-full flex items-center justify-center text-white/60 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <a href="https://youtube.com/@irisglobal" target="_blank" class="w-10 h-10 bg-navy-800 hover:bg-navy-700 rounded-full flex items-center justify-center text-white/60 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-3">
                    <li><a href="#speakers" class="text-white/50 hover:text-white text-sm transition-colors">Speakers</a></li>
                    <li><a href="#schedule" class="text-white/50 hover:text-white text-sm transition-colors">Schedule</a></li>
                    <li><a href="{{ route('workshops') }}" class="text-white/50 hover:text-white text-sm transition-colors">Workshops</a></li>
                    <li><a href="{{ route('program') }}" class="text-white/50 hover:text-white text-sm transition-colors">Full Program</a></li>
                                        <li><a href="#faq" class="text-white/50 hover:text-white text-sm transition-colors">FAQ</a></li>
                </ul>
            </div>

            {{-- Registration --}}
            <div>
                <h4 class="text-white font-semibold mb-4">Registration</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('register') }}" class="text-white/50 hover:text-white text-sm transition-colors">Attendee Registration</a></li>
                    <li><a href="{{ route('register.ministry') }}" class="text-white/50 hover:text-white text-sm transition-colors">Ministry Team Application</a></li>
                    <li><a href="{{ route('volunteer') }}" class="text-white/50 hover:text-white text-sm transition-colors">Volunteer Application</a></li>
                    <li><a href="mailto:info@europerevival.org" class="text-white/50 hover:text-white text-sm transition-colors">Contact Us</a></li>
                </ul>
                
                {{-- Newsletter --}}
                <div class="mt-6">
                    <h4 class="text-white font-semibold mb-3 text-sm">Stay Updated</h4>
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex gap-2">
                        @csrf
                        <input type="email" name="email" placeholder="Your email" 
                               class="flex-1 px-4 py-2 bg-navy-800 border border-navy-600 rounded-lg text-sm text-white placeholder-white/40 focus:outline-none focus:border-primary-500 transition-colors">
                        <button type="submit" class="px-4 py-2 bg-primary-500 hover:bg-primary-400 text-navy-800 font-semibold rounded-lg text-sm transition-colors">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="mt-16 pt-8 border-t border-white/5 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-white/40 text-sm">
                © {{ date('Y') }} Europe Revival / Iris Global. All rights reserved.
            </p>
            <div class="flex items-center gap-6">
                <a href="{{ route('privacy') }}" class="text-white/40 hover:text-white text-sm transition-colors">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="text-white/40 hover:text-white text-sm transition-colors">Terms of Use</a>
            </div>
        </div>
    </div>
</footer>
