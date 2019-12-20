<?php

namespace App\Services\Frontend\Rules;

use App\Data\Models\Basket;
use App\Data\Models\Product;
use Illuminate\Contracts\Validation\Rule;
use App\Data\Repositories\ProductRepository;

/**
 * Class EnoughBonusesRule
 * @package App\Services\Frontend\Rules
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class EnoughProductsRule implements Rule
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var array
     */
    private $products;

    /**
     * EnoughBonuses constructor.
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct()
    {
        $this->productRepository = app()->make(ProductRepository::class);
        $this->products = session()->get(Basket::PRODUCTS_SESSION_NAME, []);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $productId
     * @return bool
     */
    public function passes($attribute, $productId)
    {
        /** @var Product $product */
        $product = $this->productRepository->find($productId);

        $count = 1;
        if (array_key_exists($productId, $this->products)) {
            $count = $this->products[$productId]['count'];
        }

        return $product->getCount() >= $count;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.not_enough_count_products');
    }
}
