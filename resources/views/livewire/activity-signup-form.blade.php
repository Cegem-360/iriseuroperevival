<div>
    @if ($submitted)
        <div class="text-center py-8">
            <div class="w-16 h-16 mx-auto bg-green-500/20 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">You're signed up!</h3>
            <p class="text-white/60">
                Thank you for signing up for {{ $activityLabel }}. We'll send you more details to your email.
            </p>
        </div>
    @else
        <form wire:submit="submit" class="space-y-4">
            @if ($activityType === 'workshop' && $workshops->isNotEmpty())
                <div>
                    <label for="workshopId" class="block text-sm font-medium text-white/70 mb-1">Select Workshop</label>
                    <select wire:model="workshopId" id="workshopId"
                        class="w-full bg-navy-800 border border-navy-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:outline-none transition-colors">
                        <option value="">Choose a workshop...</option>
                        @foreach ($workshops as $workshop)
                            <option value="{{ $workshop->id }}">{{ $workshop->title }}</option>
                        @endforeach
                    </select>
                    @error('workshopId')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="firstName" class="block text-sm font-medium text-white/70 mb-1">First Name</label>
                    <input wire:model="firstName" type="text" id="firstName" placeholder="Your first name"
                        class="w-full bg-navy-800 border border-navy-600 rounded-lg px-4 py-2.5 text-white placeholder-white/40 focus:border-primary-500 focus:outline-none transition-colors">
                    @error('firstName')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="lastName" class="block text-sm font-medium text-white/70 mb-1">Last Name</label>
                    <input wire:model="lastName" type="text" id="lastName" placeholder="Your last name"
                        class="w-full bg-navy-800 border border-navy-600 rounded-lg px-4 py-2.5 text-white placeholder-white/40 focus:border-primary-500 focus:outline-none transition-colors">
                    @error('lastName')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-white/70 mb-1">Email</label>
                <input wire:model="email" type="email" id="email" placeholder="you@example.com"
                    class="w-full bg-navy-800 border border-navy-600 rounded-lg px-4 py-2.5 text-white placeholder-white/40 focus:border-primary-500 focus:outline-none transition-colors">
                @error('email')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-white/70 mb-1">Phone (optional)</label>
                <input wire:model="phone" type="tel" id="phone" placeholder="+36 30 123 4567"
                    class="w-full bg-navy-800 border border-navy-600 rounded-lg px-4 py-2.5 text-white placeholder-white/40 focus:border-primary-500 focus:outline-none transition-colors">
                @error('phone')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="notes" class="block text-sm font-medium text-white/70 mb-1">Notes (optional)</label>
                <textarea wire:model="notes" id="notes" rows="3" placeholder="Any additional information..."
                    class="w-full bg-navy-800 border border-navy-600 rounded-lg px-4 py-2.5 text-white placeholder-white/40 focus:border-primary-500 focus:outline-none transition-colors"></textarea>
                @error('notes')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" wire:loading.attr="disabled"
                class="btn-primary w-full justify-center">
                <span wire:loading.remove>Sign Up</span>
                <span wire:loading>Submitting...</span>
            </button>
        </form>
    @endif
</div>
