@component('mail::message')
# Hello, {{ $user->name }}

Your volunteer application status has been updated.

@switch($status)
    @case(\App\Enums\VolunteerStatusTypeEnum::APPROVED)
Congratulations!🎉  Your application has been **approved**. We’re excited to have you on board.
        @break
    @case(\App\Enums\VolunteerStatusTypeEnum::REJECTED)
Unfortunately ❌, your application has been **rejected**. Feel free to apply again in the future.
        @break
@endswitch

@component('mail::button', ['url' => url('/')])
Visit Our Website
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
