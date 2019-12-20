<?php

namespace App\Services\Frontend\Http\Requests\Auth;

use Framework\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegisterRequest
 * @package App\Services\Frontend\Http\Requests\Auth
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class RegisterRequest extends FormRequest
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
            'name'     => 'required|string|min:3|max:255',
            'surname'  => 'required|string|min:3|max:255',
            'email'    => 'email|required|unique:users',
            'password' => 'required|string|min:6|max:255|confirmed',
            'phone' => [
                'required',
                new PhoneRule(),
            ],
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
