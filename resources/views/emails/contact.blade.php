
@component('mail::message')
# Thank You for Contacting Us

Dear {{ $inquiry->name }},

We greatly appreciate you taking the time to reach out to us. Your message has been successfully received, and we wanted to confirm that we've got all the details you provided.

Here's a summary of your inquiry:

**Subject:** {{ $inquiry->subject }}<br>
**Message:**
{{ $inquiry->message }}

We understand the importance of your inquiry and want to assure you that our team is committed to addressing your concerns or questions promptly. We strive to respond to all inquiries within 24-48 hours during our regular business days.

In the meantime, here are a few things you might find helpful:

- Visit our FAQ page for quick answers to common questions
- Explore our blog for the latest updates and insights
- Follow us on social media for real-time news and interaction

If you have any additional information to add to your inquiry or if you need immediate assistance, please don't hesitate to reply to this email or contact our support team directly.

We look forward to assisting you and thank you once again for reaching out to us.

Best regards,
The {{ config('app.name') }} Team

@component('mail::button', ['url' => config('app.url')])
{{ __('Visit our website') }}
@endcomponent

Thanks,
{{ config('app.name') }} Team
@endcomponent
