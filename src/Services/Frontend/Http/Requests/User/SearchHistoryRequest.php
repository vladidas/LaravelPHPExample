<?php

namespace App\Services\Frontend\Http\Requests\User;

use App\Data\Models\Product;
use App\Data\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SearchHistoryRequest
 * @package App\Services\Frontend\Http\Requests\User
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class SearchHistoryRequest extends FormRequest
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
            'transaction' => 'nullable|integer|max:255',
            'date_start'  => 'nullable|date',
            'date_end'    => 'nullable|date|after_or_equal:date_start',
            'sort_id'     => [
                'nullable',
                'numeric',
                Rule::in(array_keys(User::getHistorySortsList()))
            ],
        ];
    }
}
