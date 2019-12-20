<?php

namespace App\Services\Dashboard\Http\Requests\User;

use Framework\Rules\PhoneRule;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateUserRequest
 * @package App\Services\Dashboard\Http\Requests\User
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class UpdateUserRequest extends FormRequest
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
            'name'  => 'required|string|min:3|max:255',
            'phone' => [
                'nullable',
                new PhoneRule(),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('admins')->ignore(auth()->user()->getId()),
            ],
            'password' => 'nullable|string|min:6|max:255|confirmed',
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'name.*' => __('app.title'),
        ];
    }
}
