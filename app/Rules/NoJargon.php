<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NoJargon
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value)
    {
        // A custom logic to detect jargon or random strings
        if (preg_match('/([A-Z]{3,}|[a-z]{3,}|[0-9]{3,})/', $value)) {
            return false; // Detected jargon
        }

        // Optionally, check if input contains meaningful words
        // Add any dictionary or word list to check against

        return true;
    }

    public function message()
    {
        return 'The :attribute contains invalid or random characters.';
    }
}
