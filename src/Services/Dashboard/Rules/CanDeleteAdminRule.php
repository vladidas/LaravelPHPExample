<?php

namespace App\Services\Dashboard\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class CanDeleteAdminRule
 * @package App\Services\Dashboard\Rules
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class CanDeleteAdminRule implements Rule
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
        return
            (
                auth()->user()->isSuperAdmin() &&
                auth()->user()->getId() != $value
            ) ||
            (
                !auth()->user()->isSuperAdmin() &&
                auth()->user()->canDeleteAdmin()
            );
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
