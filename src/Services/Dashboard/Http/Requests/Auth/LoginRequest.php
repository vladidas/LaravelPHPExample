<?php

namespace App\Services\Dashboard\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginRequest
 * @package App\Services\Dashboard\Http\Requests\Auth
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
            'email'    => 'email|required|exists:admins',
            'password' => 'required',
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
