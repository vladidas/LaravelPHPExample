<?php

namespace App\Services\Frontend\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginRequest
 * @package App\Services\Frontend\Http\Requests\Auth
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class LoginRequest extends FormRequest
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
            'email'    => 'email|required|exists:users',
            'password' => 'required|string|min:6|max:255',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'email.exists' => __('messages.email_not_exist')
        ];
    }
}
