<?php

namespace App\Services\Dashboard\Http\Requests\Admin;

use App\Data\Models\Admin;
use Framework\Rules\PhoneRule;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Services\Dashboard\Rules\OnlyOutletWorkersRule;

/**
 * Class StoreAdminRequest
 * @package App\Services\Dashboard\Http\Requests\Admin
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class StoreAdminRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        /** @var Admin $admin */
        $admin = new Admin();

        /** @var Get all roles except SuperAdmin. $roles */
        $roles = $admin->getRoles();
        unset($roles[$admin::ROLE_SUPER_ADMIN]);

        return [
            'name'     => 'required|string|max:255',
            'surname'  => 'required|string|max:255',
            'role_id'  => [
                'required',
                'string',
                Rule::in(array_keys($roles)),
                new OnlyOutletWorkersRule(),
            ],
            'phone' => [
                'nullable',
                new PhoneRule(),
            ],
            'email'    => [
                'required',
                'email',
                'max:255',
                Rule::unique('admins'),
            ],
            'password'         => 'nullable|string|min:6|max:255|confirmed',
            'can_edit_admin'   => 'nullable|boolean',
            'can_delete_admin' => 'nullable|boolean',
            'send_letters'     => 'nullable|boolean',
            'outlet_ids'       => 'required|array',
            'outlet_ids.*'     => 'required|numeric|exists:outlets,id',
        ];
    }
}
