<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AllowedRatios implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $width = $value->dimensions()[0];
        $height = $value->dimensions()[1];

        if (!($width == $height || 3 * $width == 2 * $height)) {
            $fail("The :attribute is invalid.");
        }
    }
}
