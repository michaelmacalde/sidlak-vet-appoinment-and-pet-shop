@component('mail::message')
# Response to Your Inquiry

## Your Inquiry

{{ $originalMessage }}

<br>
<br>
## Our Response

{!! str($replyMessage)->sanitizeHtml() !!}

<br>
<br>
@component('mail::panel')
Thank you for reaching out to us. We appreciate your message and hope this response addresses your inquiry.
@endcomponent

@component('mail::button', ['url' => url('/')])
Visit Our Website
@endcomponent

@endcomponent
