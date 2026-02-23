<x-mail::message>
# Your Volunteer Application Has Been Accepted!

Dear {{ $registration->first_name }},

We are glad to inform you that your volunteer application has been accepted!

You can attend the event at a discounted rate!

<x-mail::panel>
**Your Coupon Code:** `{{ $couponCode }}`
</x-mail::panel>

You can now book your discounted ticket: click the button below and enter the coupon code to claim your discount.

<x-mail::button :url="$registerUrl">
Book Your Discounted Ticket
</x-mail::button>

We will send more details about your volunteer work by email soon.

Thank you for joining the team, and we look forward to seeing you at the event!

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
