<?php

namespace App\Services\Dashboard\Http\Requests\Admin;

use App\Data\Models\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SearchAdminRequest
 * @package App\Services\Dashboard\Http\Requests\Admin
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class SearchAdminRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => 'nullable|string|max:255',
            'surname' => 'nullable|string|max:255',
            'role_id' => [
                'nullable',
                'numeric',
                Rule::in(array_keys(Admin::getRoles()))
            ],
            'sort_id' => [
                'nullable',
                'numeric',
                Rule::in(array_keys(Admin::getSortsList()))
            ],
        ];
    }
}
