<x-mail::message>
# Thank You for Your Donation!

Dear {{ $donor_name }},

We are deeply grateful for your generous donation of **₱{{ number_format($donor_amount, 2) }}**. Your support makes a significant difference in helping us care for animals in need.
<br><br>
## Donation Receipt Details:

**Receipt Number:** {{ $donation_number }}<br>
**Date:** {{ $created_at }}<br>
**Amount:** ₱{{ number_format($donor_amount, 2) }}<br>
**Payment Method:** {{ ucwords($donor_payment_method) }}

## Your Message:
{{ $donor_message }}
<br>
<br>
## Your Information:

**Name:** {{ $donor_name }}<br>
**Email:** {{ $donor_email }}<br>
**Phone:** {{ $donor_phone_number }}<br>
**Address:** {{ $donor_address }}<br>
<br>
<br>
## Your contribution will be used to:<br>
- Provide food and shelter for rescued animals
- Cover medical expenses and treatments
- Support our adoption program
- Maintain our facilities

<br>
<x-mail::button :url="$url" color="primary">
Visit Our Website
</x-mail::button>
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



