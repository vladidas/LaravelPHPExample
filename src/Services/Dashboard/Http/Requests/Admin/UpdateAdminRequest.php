<?php

namespace App\Services\Dashboard\Http\Requests\Admin;

use App\Data\Models\Admin;
use App\Services\Dashboard\Rules\NotPresentRule;
use Framework\Rules\PhoneRule;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Services\Dashboard\Rules\CanEditAdminRule;

/**
 * Class UpdateAdminRequest
 * @package App\Services\Dashboard\Http\Requests\Admin
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class UpdateAdminRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function all($keys = null)
    {
        $data = parent::all();
        $data['admin_id'] = $this->route('id');

        return $data;
    }

    public function rules(): array
    {
        /** @var Admin $admin */
        $admin = new Admin();

        /** @var Get all roles except SuperAdmin. $roles */
        $roles = $admin->getRoles();
        unset($roles[$admin::ROLE_SUPER_ADMIN]);

        return [
            'admin_id' => [
                new CanEditAdminRule()
            ],
            'name'     => 'required|string|max:255',
            'surname'  => 'required|string|max:255',
            'role_id'  => [
                'required',
                'string',
                Rule::in(array_keys($roles))
            ],
            'phone' => [
                'nullable',
                new PhoneRule(),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('admins')->ignore($this->route('id')),
            ],
            'password'       => 'nullable|string|min:6|max:255|confirmed',
            'can_edit_admin' => [
                'boolean',
                $this->get('role_id') == Admin::ROLE_SELLER
                    ? new NotPresentRule()
                    : 'nullable',
            ],
            'can_delete_admin' => [
                'boolean',
                $this->get('role_id') == Admin::ROLE_SELLER
                    ? new NotPresentRule()
                    : 'nullable',
            ],
            'send_letters'     => 'nullable|boolean',
            'outlet_ids'       => 'required|array',
            'outlet_ids.*'     => 'required|numeric|exists:outlets,id',
        ];
    }
}
