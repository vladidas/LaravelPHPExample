<?php

namespace App\Domains\Auth\User\Jobs;

use Lucid\Foundation\Job;
use App\Data\Models\Basket;
use App\Data\Models\Product;
use App\Data\Repositories\ProductRepository;

/**
 * Class GetSumBonusesByUserJob
 * @package App\Domains\Auth\User\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class GetSumBonusesByUserJob extends Job
{
    /**
     * @param ProductRepository $productRepository
     * @param Basket $basket
     * @return mixed
     */
    public function handle(ProductRepository $productRepository, Basket $basket): float
    {
        $productsFromSession = $basket->getProducts();
        $products = $productRepository->getProductsByIds(array_keys($productsFromSession));

        $sum = 0;
        /** @var Product $product */
        foreach ($products as $product) {
            $sum += $product->getPrice() * $productsFromSession[$product->getId()]['count'];
        }

        return $sum;
    }
}
