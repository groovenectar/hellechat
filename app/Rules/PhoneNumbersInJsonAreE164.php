<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;
use NumberFormatter;

class PhoneNumbersInJsonAreE164 implements Rule
{
    public $badIndexes = [];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $numbers = array_values(json_decode($value, true));
        Log::debug($numbers);
        for($i=0; $i < count($numbers); $i++){
            if(preg_match('/\+[1-9]\d{1,14}/', $numbers[$i]) !== 1){
                $this->badIndexes[] = $i;
            }
        }
        return count($this->badIndexes) == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $numberFormatter = new NumberFormatter('en_US', NumberFormatter::ORDINAL);
        $array = array_map(fn($item) => $numberFormatter->format(($item+1)), $this->badIndexes);
        $last  = array_slice($array, -1);
        $first = join(', ', array_slice($array, 0, -1));
        $both  = array_filter(array_merge(array($first), $last), 'strlen');
        $plural = count($this->badIndexes) > 1 ? true : false;

        $message = "The ". join(' and ', $both);
        $message .= $plural ? " phone numbers" : " phone number";
        $message .= $plural ? " are not" : " is not";
        $message .= " in E.164 format.";

        return $message;
    }
}
