<x-mail::message>
# Welcome to our volunteer program!

# Hello {{ $name }},

Thank you for joining our volunteer program!

**Your role:** {{ ucwords(str_replace('_', ' ', $role)) }} <br>
**Your temporary password:** {{ $temporaryPassword }}

<x-mail::button :url="$resetUrl" color="primary">
Set Your New Password
</x-mail::button>

Please use the above link to set your password and complete your registration.

Thank you for your commitment to making a difference!

Thanks,<br>
Sidlak Animal Welfare({{ config('app.name') }}) Team
</x-mail::message>
