<?php

use Rakit\Validation\Rule;

class CanadaPhone extends Rule
{
    protected $message = ":attribute :value has been used";


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
