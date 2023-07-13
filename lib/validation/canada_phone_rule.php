<?php

use Rakit\Validation\Rule;

class CanadaPhone extends Rule
{
    protected $message = ":value is not a valid Canadian phone number!";


    public function check($value): bool
    {

        $canadaPattern = '/^\+?1?\s*\(?(?:(?:[2-9][0-9]{2})\)?[-.\s]?){2}(?:[0-9]{4})$/';
        $cleanedNumber = preg_replace('/\D/', '', $value);
        if (preg_match($canadaPattern, $cleanedNumber)) {
            return true;
        } else {
            return false;
        }
    }
}
