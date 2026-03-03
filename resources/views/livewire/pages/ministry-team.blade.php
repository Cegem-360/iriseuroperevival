<div>
    {{-- ============================================
    HERO SECTION
    ============================================= --}}
    <section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-linear-to-br from-navy-950 via-navy-800 to-navy-950"></div>
        <div class="absolute inset-0">
            <img src="{{ Vite::asset('resources/images/crowd-2.webp') }}" alt="" class="w-full h-full object-cover opacity-20">
        </div>
        <div class="absolute inset-0 bg-linear-to-t from-navy-950 via-transparent to-navy-950/50"></div>

        {{-- Decorative blurs --}}
        <div class="absolute top-20 left-10 w-72 h-72 bg-sky-400/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl"></div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20">
            {{-- Breadcrumb --}}
            <nav class="flex justify-center mb-8" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li><a href="{{ route('home') }}" class="text-white/40 hover:text-sky-400 transition-colors">Főoldal</a></li>
                    <li class="text-white/20">/</li>
                    <li class="text-sky-400">Ministry Team</li>
                </ol>
            </nav>

            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-sky-400/10 border border-sky-400/20 mb-6">
                <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
                <span class="text-sky-400 font-medium">Szolgálj velünk</span>
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                Csatlakozz a
                <span class="block text-gradient">Ministry Teamhez</span>
            </h1>

            <p class="text-xl text-white/70 mb-8 max-w-2xl mx-auto">
                Legyél részese annak, ahogy Isten megérinti az emberek életét az Europe Revival 2026-on. Jelentkezz szolgálatra a gyógyító szobákban, prófétai szolgálatban, evangelizációban és még sok más területen.
            </p>

            {{-- Stats --}}
            <div class="flex flex-wrap justify-center gap-8 mt-12">
                <div class="text-center">
                    <div class="text-3xl font-bold text-sky-400">1 nap</div>
                    <div class="text-white/40 text-sm">tréning</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-sky-400">9+</div>
                    <div class="text-white/40 text-sm">szolgálati terület</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-sky-400">Ingyenes</div>
                    <div class="text-white/40 text-sm">konferencia belépő</div>
                </div>
            </div>

            {{-- Scroll indicator --}}
            <a href="#about" class="inline-flex flex-col items-center mt-12 text-white/40 hover:text-sky-400 transition-colors">
                <span class="text-sm mb-2">Tudj meg többet</span>
                <svg class="w-6 h-6 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </a>
        </div>
    </section>

    {{-- ============================================
    ABOUT MINISTRY TEAM SECTION
    ============================================= --}}
    <section id="about" class="py-20 bg-navy-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                {{-- Content --}}
                <div>
                    <span class="text-sky-400 font-semibold text-sm uppercase tracking-wider">Miért csatlakozz?</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mt-2 mb-6">
                        Szolgálj Isten Királyságáért
                    </h2>
                    <p class="text-white/70 text-lg mb-6">
                        A Ministry Team tagjai különleges lehetőséget kapnak arra, hogy aktívan részt vegyenek abban, ahogy Isten munkálkodik a konferencián.
                    </p>
                    <p class="text-white/50 mb-8">
                        Szolgálatodért cserébe ingyenes konferencia belépőt kapsz, és részt vehetsz a csütörtöki tréning napon.
                    </p>

                    {{-- Benefits --}}
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-sky-400/10 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold">Ingyenes konferencia belépő</h4>
                                <p class="text-white/40 text-sm">Jóváhagyott jelentkezőknek ingyenes belépés</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-sky-400/10 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold">Kötelező tréning nap</h4>
                                <p class="text-white/40 text-sm">Október 22-én (csütörtök) a konferencia előtt</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-sky-400/10 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold">Nemzetközi csapat</h4>
                                <p class="text-white/40 text-sm">Szolgálj együtt testvérekkel Európa minden részéről</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Image --}}
                <div class="relative">
                    <div class="absolute -inset-4 bg-linear-to-r from-sky-400/20 to-primary-500/20 rounded-2xl blur-2xl"></div>
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-[4/3] bg-navy-700">
                        <img src="{{ Vite::asset('resources/images/crowd-1.webp') }}" alt="Ministry Team" class="w-full h-full object-cover">
                    </div>

                    {{-- Floating card --}}
                    <div class="absolute -bottom-6 -left-6 bg-navy-800/90 backdrop-blur-sm rounded-xl p-4 border border-navy-600">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-linear-to-r from-sky-400 to-primary-500 flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-white font-bold">Csapatban szolgálunk</div>
                                <div class="text-white/40 text-sm">Együtt Isten dicsőségére</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
    SERVICE AREAS SECTION
    ============================================= --}}
    <section id="service-areas" class="py-20 bg-linear-to-b from-navy-950 to-navy-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-sky-400 font-semibold text-sm uppercase tracking-wider">Szolgálati területek</span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mt-2 mb-4">
                    Hol szeretnél szolgálni?
                </h2>
                <p class="text-white/50 max-w-2xl mx-auto">
                    Válaszd ki azokat a területeket, ahol szívesen szolgálnál. Több területet is megjelölhetsz.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Evangelizációs csoportvezetők --}}
                <div class="group bg-navy-700/50 backdrop-blur-sm rounded-xl p-6 border border-navy-600 hover:border-sky-400/50 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-linear-to-br from-sky-400 to-ocean-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Evangelizációs csoportvezető</h3>
                    <p class="text-white/50 text-sm mb-4">Kis evangelizációs csoportok vezetése, koordinálása az utcai missziós alkalmakon.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2 py-1 rounded-full bg-sky-400/10 text-sky-400 text-xs">utcai misszió</span>
                        <span class="px-2 py-1 rounded-full bg-sky-400/10 text-sky-400 text-xs">vezetés</span>
                    </div>
                </div>

                {{-- Gyógyító szobák --}}
                <div class="group bg-navy-700/50 backdrop-blur-sm rounded-xl p-6 border border-navy-600 hover:border-sky-400/50 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-linear-to-br from-sky-400 to-ocean-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Gyógyító szobák</h3>
                    <p class="text-white/50 text-sm mb-4">Ima a betegekért, személyes imaszolgálat a gyógyulásért keresőknek. 15 perces személyes szolgálati alkalmak.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2 py-1 rounded-full bg-sky-400/10 text-sky-400 text-xs">ima</span>
                        <span class="px-2 py-1 rounded-full bg-sky-400/10 text-sky-400 text-xs">személyes szolgálat</span>
                    </div>
                </div>

                {{-- Prófétai szobák --}}
                <div class="group bg-navy-700/50 backdrop-blur-sm rounded-xl p-6 border border-navy-600 hover:border-sky-400/50 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-linear-to-br from-ocean-500 to-sky-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Prófétai szobák</h3>
                    <p class="text-white/50 text-sm mb-4">Prófétai szolgálat, bátorító szavak, Isten szívének közvetítése az emberek felé.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2 py-1 rounded-full bg-ocean-500/10 text-ocean-400 text-xs">prófétai</span>
                        <span class="px-2 py-1 rounded-full bg-ocean-500/10 text-ocean-400 text-xs">személyes szolgálat</span>
                    </div>
                </div>

                {{-- Dicsőítő csapat --}}
                <div class="group bg-navy-700/50 backdrop-blur-sm rounded-xl p-6 border border-navy-600 hover:border-sky-400/50 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-linear-to-br from-sky-400 to-ocean-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Dicsőítő csapat</h3>
                    <p class="text-white/50 text-sm mb-4">Zenei szolgálat a dicsőítő csapatban. Énekesek és hangszeres zenészek.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2 py-1 rounded-full bg-sky-400/10 text-sky-400 text-xs">zene</span>
                        <span class="px-2 py-1 rounded-full bg-sky-400/10 text-sky-400 text-xs">színpad</span>
                    </div>
                </div>

                {{-- Ima csapat --}}
                <div class="group bg-navy-700/50 backdrop-blur-sm rounded-xl p-6 border border-navy-600 hover:border-sky-400/50 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-linear-to-br from-ocean-500 to-sky-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Ima csapat</h3>
                    <p class="text-white/50 text-sm mb-4">Közbenjáró ima a konferenciáért, az előadókért és a résztvevőkért a háttérben.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2 py-1 rounded-full bg-ocean-500/10 text-ocean-400 text-xs">közbenjárás</span>
                        <span class="px-2 py-1 rounded-full bg-ocean-500/10 text-ocean-400 text-xs">háttér</span>
                    </div>
                </div>

                {{-- Gyermek szolgálat --}}
                <div class="group bg-navy-700/50 backdrop-blur-sm rounded-xl p-6 border border-navy-600 hover:border-sky-400/50 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-linear-to-br from-primary-400 to-primary-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Gyermek szolgálat</h3>
                    <p class="text-white/50 text-sm mb-4">Gyermekprogram 4-12 éves korig a főprogramok alatt. Játékok, tanítás, dicsőítés.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2 py-1 rounded-full bg-primary-500/10 text-primary-400 text-xs">gyerekek</span>
                        <span class="px-2 py-1 rounded-full bg-primary-500/10 text-primary-400 text-xs">kreatív</span>
                    </div>
                </div>

                {{-- Fogadó szolgálat --}}
                <div class="group bg-navy-700/50 backdrop-blur-sm rounded-xl p-6 border border-navy-600 hover:border-sky-400/50 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-linear-to-br from-sky-400 to-ocean-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Fogadó szolgálat</h3>
                    <p class="text-white/50 text-sm mb-4">Vendégek fogadása, regisztráció, tájékoztatás, segítség a helyszínen.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2 py-1 rounded-full bg-sky-400/10 text-sky-400 text-xs">fogadás</span>
                        <span class="px-2 py-1 rounded-full bg-sky-400/10 text-sky-400 text-xs">szolgálat</span>
                    </div>
                </div>

                {{-- Technikai csapat --}}
                <div class="group bg-navy-700/50 backdrop-blur-sm rounded-xl p-6 border border-navy-600 hover:border-sky-400/50 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-linear-to-br from-ocean-500 to-sky-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Technikai csapat</h3>
                    <p class="text-white/50 text-sm mb-4">Hang, fény, vetítés és élő közvetítés kezelése a konferencia alatt.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2 py-1 rounded-full bg-ocean-500/10 text-ocean-400 text-xs">technika</span>
                        <span class="px-2 py-1 rounded-full bg-ocean-500/10 text-ocean-400 text-xs">közvetítés</span>
                    </div>
                </div>

                {{-- Fordítók --}}
                <div class="group bg-navy-700/50 backdrop-blur-sm rounded-xl p-6 border border-navy-600 hover:border-sky-400/50 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-linear-to-br from-primary-400 to-primary-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Fordítók</h3>
                    <p class="text-white/50 text-sm mb-4">Szinkrontolmácsolás és fordítás különböző nyelveken a konferencia alatt.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2 py-1 rounded-full bg-primary-500/10 text-primary-400 text-xs">nyelvek</span>
                        <span class="px-2 py-1 rounded-full bg-primary-500/10 text-primary-400 text-xs">tolmácsolás</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
    TRAINING DAY SECTION
    ============================================= --}}
    <section class="py-20 bg-navy-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-linear-to-r from-sky-400/10 to-primary-500/10 rounded-2xl p-8 md:p-12 border border-sky-400/20">
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-400/20 text-sky-400 text-sm font-medium mb-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Kötelező
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold text-white mb-4">
                            Tréning Nap
                        </h3>
                        <p class="text-white/70 mb-6">
                            A tréning nap kötelező minden Ministry Team tag számára. Itt kapod meg a felkészítést, a szolgálati irányelveket és az akkreditációdat.
                        </p>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 text-white/70">
                                <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span><strong>2026. október 22. (csütörtök)</strong></span>
                            </div>
                            <div class="flex items-center gap-3 text-white/70">
                                <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>09:00 – 18:00</span>
                            </div>
                            <div class="flex items-center gap-3 text-white/70">
                                <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Vezeti: David Gava</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-navy-900/50 rounded-xl p-6">
                        <h4 class="text-white font-semibold mb-4">Program</h4>
                        <div class="space-y-4">
                            <div class="flex gap-4">
                                <div class="text-sky-400 font-mono text-sm w-20">09:00</div>
                                <div class="text-white/70">Regisztráció, köszöntés</div>
                            </div>
                            <div class="flex gap-4">
                                <div class="text-sky-400 font-mono text-sm w-20">10:00</div>
                                <div class="text-white/70">Dicsőítés</div>
                            </div>
                            <div class="flex gap-4">
                                <div class="text-sky-400 font-mono text-sm w-20">10:30</div>
                                <div class="text-white/70">Tanítás: A szolgálat alapjai</div>
                            </div>
                            <div class="flex gap-4">
                                <div class="text-sky-400 font-mono text-sm w-20">12:30</div>
                                <div class="text-white/70">Ebéd (biztosított)</div>
                            </div>
                            <div class="flex gap-4">
                                <div class="text-sky-400 font-mono text-sm w-20">14:00</div>
                                <div class="text-white/70">Szolgálati területek bemutatása</div>
                            </div>
                            <div class="flex gap-4">
                                <div class="text-sky-400 font-mono text-sm w-20">16:00</div>
                                <div class="text-white/70">Gyakorlati felkészülés csoportokban</div>
                            </div>
                            <div class="flex gap-4">
                                <div class="text-sky-400 font-mono text-sm w-20">17:30</div>
                                <div class="text-white/70">Záró ima, áldás</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
    FAQ SECTION
    ============================================= --}}
    <section id="faq" class="py-20 bg-navy-950">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-sky-400 font-semibold text-sm uppercase tracking-wider">GYIK</span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mt-2 mb-4">
                    Gyakran ismételt kérdések
                </h2>
                <p class="text-white/50">
                    Válaszok a leggyakoribb kérdésekre a Ministry Team-ről
                </p>
            </div>

            <div class="space-y-4" x-data="{ open: null }">
                {{-- Szállás --}}
                <div class="bg-navy-700/50 rounded-xl border border-navy-600 overflow-hidden">
                    <button @click="open = open === 1 ? null : 1" type="button" class="w-full px-6 py-4 text-left flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-sky-400/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                            </div>
                            <span class="text-white font-semibold">Hogyan oldjam meg a szállást?</span>
                        </div>
                        <svg class="w-5 h-5 text-white/40 transition-transform" :class="{ 'rotate-180': open === 1 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === 1" x-cloak x-collapse class="px-6 pb-4">
                        <div class="pl-13 text-white/50 space-y-2">
                            <p>A szállásról minden résztvevőnek önállóan kell gondoskodnia.</p>
                            <p>Budapest széles szálláskínálatot nyújt minden árkategóriában.</p>
                            <ul class="list-disc list-inside space-y-1 mt-3">
                                <li>Airbnb apartmanok</li>
                                <li>Szállodák a helyszín közelében</li>
                                <li>Gyülekezeti vendégházak (érdeklődj nálunk)</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Étkezés --}}
                <div class="bg-navy-700/50 rounded-xl border border-navy-600 overflow-hidden">
                    <button @click="open = open === 2 ? null : 2" type="button" class="w-full px-6 py-4 text-left flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-sky-400/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <span class="text-white font-semibold">Van étkezés biztosítva?</span>
                        </div>
                        <svg class="w-5 h-5 text-white/40 transition-transform" :class="{ 'rotate-180': open === 2 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === 2" x-cloak x-collapse class="px-6 pb-4">
                        <div class="pl-13 text-white/50 space-y-2">
                            <p>Az étkezés nem része a regisztrációnak, de a helyszínen food truck-ok és büfék lesznek elérhetők megfizethető árakon.</p>
                            <p>A környéken számos étterem található.</p>
                            <div class="bg-navy-900/50 rounded-lg p-4 mt-3">
                                <p class="text-sky-400 font-medium">A tréning napon ebédet biztosítunk a Ministry Team tagoknak!</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Közlekedés --}}
                <div class="bg-navy-700/50 rounded-xl border border-navy-600 overflow-hidden">
                    <button @click="open = open === 3 ? null : 3" type="button" class="w-full px-6 py-4 text-left flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-sky-400/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                </svg>
                            </div>
                            <span class="text-white font-semibold">Hogyan jutok el a helyszínre?</span>
                        </div>
                        <svg class="w-5 h-5 text-white/40 transition-transform" :class="{ 'rotate-180': open === 3 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === 3" x-cloak x-collapse class="px-6 pb-4">
                        <div class="pl-13 text-white/50 space-y-2">
                            <p>Budapest könnyen megközelíthető repülővel, vonattal és busszal egyaránt.</p>
                            <ul class="list-disc list-inside space-y-1 mt-3">
                                <li>Repülőtérről: 100E busz a Deák térig (~30 perc)</li>
                                <li>Metró és villamos a helyszín közelében</li>
                                <li>Parkolás korlátozott – tömegközlekedés ajánlott</li>
                            </ul>
                            <p class="mt-3">Részletes útmutatót küldünk a jóváhagyás után.</p>
                        </div>
                    </div>
                </div>

                {{-- Jelentkezés folyamata --}}
                <div class="bg-navy-700/50 rounded-xl border border-navy-600 overflow-hidden">
                    <button @click="open = open === 4 ? null : 4" type="button" class="w-full px-6 py-4 text-left flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-sky-400/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-white font-semibold">Hogyan zajlik a jelentkezés?</span>
                        </div>
                        <svg class="w-5 h-5 text-white/40 transition-transform" :class="{ 'rotate-180': open === 4 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === 4" x-cloak x-collapse class="px-6 pb-4">
                        <div class="pl-13 text-white/50 space-y-2">
                            <p>A jelentkezés egyszerű, négy lépésből áll:</p>
                            <ol class="list-decimal list-inside space-y-2 mt-3">
                                <li>Töltsd ki az online jelentkezési űrlapot</li>
                                <li>Megkeressük a lelkipásztorodat referenciáért</li>
                                <li>Elbíráljuk a jelentkezésedet</li>
                                <li>E-mailben értesítünk a döntésről</li>
                            </ol>
                        </div>
                    </div>
                </div>

                {{-- Mit kell hozni --}}
                <div class="bg-navy-700/50 rounded-xl border border-navy-600 overflow-hidden">
                    <button @click="open = open === 5 ? null : 5" type="button" class="w-full px-6 py-4 text-left flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-sky-400/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>
                            </div>
                            <span class="text-white font-semibold">Mit kell hoznom magammal?</span>
                        </div>
                        <svg class="w-5 h-5 text-white/40 transition-transform" :class="{ 'rotate-180': open === 5 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === 5" x-cloak x-collapse class="px-6 pb-4">
                        <div class="pl-13 text-white/50 space-y-2">
                            <p>A következő dolgokra lesz szükséged:</p>
                            <ul class="list-disc list-inside space-y-1 mt-3">
                                <li>Személyi igazolvány vagy útlevél</li>
                                <li>Biblia és jegyzetfüzet</li>
                                <li>Kényelmes ruházat és cipő a szolgálathoz</li>
                                <li>Szükséges gyógyszerek</li>
                                <li>Nyitott szív a szolgálatra!</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Lelkipásztori ajánlás --}}
                <div class="bg-navy-700/50 rounded-xl border border-navy-600 overflow-hidden">
                    <button @click="open = open === 6 ? null : 6" type="button" class="w-full px-6 py-4 text-left flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-sky-400/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <span class="text-white font-semibold">Miért kell lelkipásztori ajánlás?</span>
                        </div>
                        <svg class="w-5 h-5 text-white/40 transition-transform" :class="{ 'rotate-180': open === 6 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === 6" x-cloak x-collapse class="px-6 pb-4">
                        <div class="pl-13 text-white/50 space-y-2">
                            <p>A lelkipásztori ajánlás biztosítja, hogy a Ministry Team tagok aktív, beépült tagjai egy helyi gyülekezetnek.</p>
                            <p class="mt-2">A lelkipásztorod igazolása:</p>
                            <ul class="list-disc list-inside space-y-1 mt-3">
                                <li>Gyülekezeti tagságod</li>
                                <li>Hited gyakorlása az életedben</li>
                                <li>Alkalmasságod a szolgálatra</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
    APPLICATION FORM SECTION
    ============================================= --}}
    <section id="apply" class="py-20 bg-linear-to-b from-navy-950 to-navy-800">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-sky-400 font-semibold text-sm uppercase tracking-wider">Jelentkezz most</span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mt-2 mb-4">
                    Ministry Team jelentkezés
                </h2>
                <p class="text-white/50">
                    Töltsd ki az alábbi űrlapot a jelentkezéshez. Jelentkezési határidő: 2026. szeptember 1.
                </p>
            </div>

           {{--  @if($submitted)
                <div class="bg-navy-700/50 backdrop-blur-sm rounded-2xl p-8 border border-navy-600 text-center">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-emerald-500/10 flex items-center justify-center">
                        <svg class="w-10 h-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Köszönjük a jelentkezésedet!</h3>
                    <p class="text-white/50 max-w-md mx-auto mb-6">
                        A jelentkezésedet megkaptuk. Hamarosan felvesszük a kapcsolatot a lelkipásztoroddal, majd e-mailben értesítünk a döntésről.
                    </p>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-sky-400 text-navy-800 font-semibold rounded-full hover:bg-sky-300 transition-colors">
                        Vissza a főoldalra
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            @else --}}
                <div class="dark fi-navy-form bg-navy-700/50 backdrop-blur-sm rounded-2xl p-8 border border-navy-600">
                    <form wire:submit="submit" class="space-y-8">
                        {{ $this->form }}
                    </form>
                </div>
            {{-- @endif --}}
        </div>
    </section>

    {{-- ============================================
    FINAL CTA SECTION
    ============================================= --}}
    <section class="py-20 bg-navy-950 relative overflow-hidden">
        <div class="absolute inset-0 bg-linear-to-r from-sky-400/5 to-primary-500/5"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-sky-400/10 rounded-full blur-3xl"></div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Légy részese a csodának!
            </h2>
            <p class="text-xl text-white/70 mb-8">
                Isten terve veled is számol ezen a konferencián. Ne maradj ki – jelentkezz még ma a Ministry Team-be!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#apply" class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl bg-linear-to-r from-primary-400 to-primary-600 hover:from-primary-500 hover:to-primary-700 text-navy-900 font-semibold transition-all duration-300 shadow-lg shadow-primary-500/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Jelentkezem most
                </a>
                <a href="mailto:ministry@iriseuroperevival.com" class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl border border-navy-600 hover:border-sky-400/50 text-white/70 hover:text-white font-semibold transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Kérdésem van
                </a>
            </div>
        </div>
    </section>
</div>
