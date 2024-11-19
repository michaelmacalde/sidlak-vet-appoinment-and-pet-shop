<x-mail::message>
# Thank You for Your Donation!

Dear {{ $donor_name }},

We are deeply grateful for your generous donation of **₱{{ number_format($donor_amount, 2) }}**. Your support makes a significant difference in helping us care for animals in need.
<br><br>
## Donation Receipt Details:

@component('mail::panel')
**Receipt Number:** {{ $donation_number }}<br>
**Date:** {{ $created_at->format('F j, Y') }}<br>
**Amount:** ₱{{ number_format($donor_amount, 2) }}<br>
**Payment Method:** {{ ucwords($donor_payment_method) }}
@endcomponent


## Your Message:
{{ $donor_message }}
<br>
## Your Information:
@component('mail::panel')
**Name:** {{ $donor_name }}<br>
**Email:** {{ $donor_email }}<br>
**Phone Number:** {{ $donor_phone_number }}<br>
 {{ $donor_address }}<br>
@endcomponent
<br>

## Your contribution will be used to:
@component('mail::panel')
<ul>
    <li>Provide food and shelter for rescued animals</li>
    <li>Cover medical expenses and treatments</li>
    <li>Support our adoption program</li>
    <li>Maintain our facilities</li>
</ul>
@endcomponent
<br>
@component('mail::button', ['url' => $url])
Visit Our Website
@endcomponent
<br>
Thanks again for your support!
<br>
<br>
Best regards,<br>
{{ config('app.name') }} Team
<br>
<br>
<br>
<small>Please keep this receipt for your tax records.
Donation Reference: {{ $donation_number }}</small>
<br>
</x-mail::message>
