<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OneWord implements Rule
{
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
        return is_string($value) && ! preg_match('/\s/u', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Community name can be only one word. You can use camel casing for multiple words. E.g. LasgidStories for "Lasgidi Stories"';
    }
}
