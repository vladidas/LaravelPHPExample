<?php

namespace App\Services\Dashboard\Rules;

use App\Data\Models\Admin;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class NotPresentRule
 * @package App\Services\Dashboard\Rules
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class NotPresentRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.not_in');
    }
}
