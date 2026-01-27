<div>
<div class="min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">{{ __('Dashboard') }}</h1>
            <p class="mt-2 text-stone-400">{{ __('View and manage your registrations') }}</p>
        </div>

        @if($registrations->isEmpty())
            <div class="rounded-lg border border-amber-500/30 bg-amber-500/10 p-6">
                <h3 class="font-semibold text-amber-400">{{ __('No Registrations') }}</h3>
                <p class="mt-2 text-stone-300">
                    {{ __('You don\'t have any registrations yet.') }}
                    <a href="{{ route('register') }}" class="text-amber-400 hover:text-amber-300 underline">{{ __('Register for the conference') }}</a>
                </p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($registrations as $registration)
                    <div class="p-6 bg-stone-900 rounded-lg border border-stone-800">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-white">
                                    {{ ucfirst($registration->type) }} {{ __('Registration') }}
                                </h3>
                                <p class="text-sm text-stone-400">
                                    {{ __('Reference') }}: {{ $registration->uuid }}
                                </p>
                            </div>
                            <div>
                                @if($registration->status === 'paid')
                                    <span class="inline-flex items-center rounded-full bg-green-500/20 px-2 py-1 text-xs font-medium text-green-400">{{ __('Paid') }}</span>
                                @elseif($registration->status === 'pending_payment')
                                    <span class="inline-flex items-center rounded-full bg-amber-500/20 px-2 py-1 text-xs font-medium text-amber-400">{{ __('Pending Payment') }}</span>
                                @elseif($registration->status === 'pending_approval')
                                    <span class="inline-flex items-center rounded-full bg-amber-500/20 px-2 py-1 text-xs font-medium text-amber-400">{{ __('Pending Approval') }}</span>
                                @elseif($registration->status === 'approved')
                                    <span class="inline-flex items-center rounded-full bg-green-500/20 px-2 py-1 text-xs font-medium text-green-400">{{ __('Approved') }}</span>
                                @elseif($registration->status === 'rejected')
                                    <span class="inline-flex items-center rounded-full bg-red-500/20 px-2 py-1 text-xs font-medium text-red-400">{{ __('Rejected') }}</span>
                                @elseif($registration->status === 'cancelled')
                                    <span class="inline-flex items-center rounded-full bg-stone-500/20 px-2 py-1 text-xs font-medium text-stone-400">{{ __('Cancelled') }}</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-stone-500/20 px-2 py-1 text-xs font-medium text-stone-400">{{ ucfirst($registration->status) }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-stone-400">{{ __('Name') }}:</span>
                                <span class="text-white ml-1">{{ $registration->full_name }}</span>
                            </div>
                            <div>
                                <span class="text-stone-400">{{ __('Email') }}:</span>
                                <span class="text-white ml-1">{{ $registration->email }}</span>
                            </div>
                            @if($registration->ticket_type)
                                <div>
                                    <span class="text-stone-400">{{ __('Ticket Type') }}:</span>
                                    <span class="text-white ml-1">{{ ucfirst($registration->ticket_type) }}</span>
                                </div>
                            @endif
                            @if($registration->amount > 0)
                                <div>
                                    <span class="text-stone-400">{{ __('Amount') }}:</span>
                                    <span class="text-white ml-1">{{ $registration->formatted_amount }}</span>
                                </div>
                            @endif
                            <div>
                                <span class="text-stone-400">{{ __('Registered') }}:</span>
                                <span class="text-white ml-1">{{ $registration->created_at->format('F j, Y') }}</span>
                            </div>
                        </div>

                        @if($registration->status === 'pending_payment' && $registration->amount > 0)
                            <div class="mt-4">
                                <a href="{{ route('register.success', $registration->uuid) }}"
                                   class="inline-flex items-center px-4 py-2 bg-amber-500 text-stone-900 font-semibold rounded-lg hover:bg-amber-400 transition-colors">
                                    {{ __('Complete Payment') }}
                                </a>
                            </div>
                        @endif

                        @if($registration->status === 'rejected' && $registration->rejection_reason)
                            <div class="mt-4 p-3 bg-red-500/10 border border-red-500/30 rounded-md">
                                <p class="text-sm text-red-400">
                                    <strong>{{ __('Reason') }}:</strong> {{ $registration->rejection_reason }}
                                </p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
</div>