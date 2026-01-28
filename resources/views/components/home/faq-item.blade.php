@props([
    'faq',
    'index',
])

<div class="accordion-item">
    <button @click="openFaq = openFaq === {{ $index }} ? null : {{ $index }}" class="accordion-trigger">
        <span class="text-white font-medium text-left">{{ $faq->question }}</span>
        <svg class="w-5 h-5 text-sky-400 transition-transform duration-300" :class="openFaq === {{ $index }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>
    <div x-show="openFaq === {{ $index }}" x-collapse>
        <div class="accordion-content">
            <p class="text-white/70">{!! nl2br(e($faq->answer)) !!}</p>
            {{ $slot }}
        </div>
    </div>
</div>
