<?php

namespace App\Services\Frontend\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PasswordRecoveryRequest
 * @package App\Services\Frontend\Http\Requests\Auth
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class PasswordRecoveryRequest extends FormRequest
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
            'email' => 'required|email|exists:users'
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
