<?php

namespace App\Services\Dashboard\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\Dashboard\Rules\CanDeleteAdminRule;

/**
 * Class DeleteAdminRequest
 * @package App\Services\Dashboard\Http\Requests\Admin
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class DeleteAdminRequest extends FormRequest
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

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'admin_id' => [
                new CanDeleteAdminRule()
            ],
        ];
    }
}
