<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueContactDetails implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $phoneNumbers = array_column($value, 'phone_number');
        $telephoneNumbers = array_column($value, 'telephone_number');

        if (count($phoneNumbers) !== count(array_unique($phoneNumbers))) {
            $fail('Each phone number must be unique.');
        }

        if (count($telephoneNumbers) !== count(array_unique($telephoneNumbers))) {
            $fail('Each telephone number must be unique.');
        }
    }
}
