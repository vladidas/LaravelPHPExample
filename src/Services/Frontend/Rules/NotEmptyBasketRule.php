<?php

namespace App\Services\Frontend\Rules;

use App\Data\Models\Basket;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class NotEmptyBasketRule
 * @package App\Services\Frontend\Rules
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class NotEmptyBasketRule implements Rule
{
    /**
     * @var array
     */
    private $products;

    /**
     * NotEmptyBasketRule constructor.
     */
    public function __construct()
    {
        $this->products = session()->get(Basket::PRODUCTS_SESSION_NAME, []);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (bool)$this->products;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.empty_basket');
    }
}
