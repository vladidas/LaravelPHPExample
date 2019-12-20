<?php

namespace App\Services\Dashboard\Http\Requests\Admin;

use App\Services\Dashboard\Rules\CanEditAdminRule;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EditAdminRequest
 * @package App\Services\Dashboard\Http\Requests\Admin
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class EditAdminRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @param null $keys
     * @return array
     */
    public function all($keys = null)
    {
        $data = parent::all();
        $data['admin_id'] = $this->route('id');

        return $data;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'admin_id' => [
                new CanEditAdminRule()
            ],
        ];
    }
}
