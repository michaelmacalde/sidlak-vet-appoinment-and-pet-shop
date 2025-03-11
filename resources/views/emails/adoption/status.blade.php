@component('mail::message')
# Hello, {{ $user->name }}

Your adoption application status has been updated.

@switch($status)
    @case(\App\Enums\AdoptionEnum::APPROVED)
**Congratulations! 🎉** Your application has been **approved**.

Here are the details of your adopted dog(s):

<table style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th style="border: 1px solid #ddd; padding: 8px;">Avatar</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Dog Name</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Age</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Breed</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Size</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Gender</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($adoptedDogs as $dog)
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                @if (!empty($dog['dog_image']['dog_image']))
                    <img src="{{ asset('storage/' . $dog['dog_image']['dog_image']) }}" alt="Dog Image" style="max-width: 70px; height: 70px; object-fit: cover;">
                @else
                    No Image Available
                @endif
            </td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $dog['dog_name'] }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $dog['dog_age'] }} year(s) old</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $dog['breed_name'] }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $dog['dog_size'] }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $dog['dog_gender'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<br>
We hope you enjoy your new companion! 🐶💖

@break

@case(\App\Enums\AdoptionEnum::REJECTED)
Unfortunately ❌, your application has been **rejected**.
Feel free to apply again in the future.

@break
@endswitch

@component('mail::button', ['url' => url('/')])
Visit Our Website
@endcomponent

Thanks, <br>
**{{ config('app.name') }} Team**
@endcomponent
