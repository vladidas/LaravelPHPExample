<?php

namespace App\Services\Dashboard\Rules;

use App\Data\Models\Admin;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class OnlyOutletWorkersRule
 * @package App\Services\Dashboard\Rules
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class OnlyOutletWorkersRule implements Rule
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
        return !(request()->get('outlet_ids') && $value == Admin::ROLE_SUPER_ADMIN);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.super_admin_cant_been_workers');
    }
}
