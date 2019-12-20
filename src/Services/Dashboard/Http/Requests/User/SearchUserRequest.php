<?php

namespace App\Services\Dashboard\Http\Requests\User;

use App\Data\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SearchUserRequest
 * @package App\Services\Dashboard\Http\Requests\User
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class SearchUserRequest extends FormRequest
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
            'sort_id' => [
                'nullable',
                'numeric',
                Rule::in(array_keys(User::getSortsList()))
            ],
        ];
    }
}
