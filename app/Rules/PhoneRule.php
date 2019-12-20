<?php

namespace Framework\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class PhoneRule
 * @package Framework\Rules
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class PhoneRule implements Rule
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
        return preg_match('/^\+?3?8?(0\d{9})$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.url');
    }
}
