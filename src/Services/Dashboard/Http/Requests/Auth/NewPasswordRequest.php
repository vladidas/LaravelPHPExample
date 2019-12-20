<?php

namespace App\Services\Dashboard\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class NewPasswordRequest
 * @package App\Services\Dashboard\Http\Requests\Auth
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class NewPasswordRequest extends FormRequest
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
            'password' => 'required|string|min:6|max:255|confirmed'
        ];
    }
}
