<?php

namespace App\Data\Repositories;

use Carbon\Carbon;
use App\Data\Models\User;
use App\Data\Models\Order;

/**
 * Class UserRepository
 * @package App\Data\Repositories
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class UserRepository extends Repository
{
    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    /**
     * @param int $id
     * @param $perPage
     * @param array $params
     * @param array $relations
     * @param string $orderBy
     * @param string $sorting
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getHistoryPaginatorWithQueryParams(
        int $id,
        $perPage,
        array $params = [],
        array $relations = [],
        string $orderBy = 'paid_at',
        string $sorting = 'desc'
    ) {
        $subQuery = $this->model->with($relations)
            ->selectRaw(
                'users.*, ' .
                '(orders.amount * -1) as transaction, ' .
                'orders.created_at as paid_at, ' .
                'orders.id as order_id, ' .
                'NULL as receipt_id'
            )
            ->join('orders', 'orders.user_id', '=', 'users.id')
            ->having('users.id', '=', $id);

        $query = $this->model->with($relations)
            ->selectRaw(
                'users.*, ' .
                'receipts.amount as transaction, ' .
                'receipts.created_at as paid_at, ' .
                'NULL as order_id, ' .
                'receipts.id as receipt_id'
            )
            ->join('receipts', 'receipts.user_id', '=', 'users.id')
            ->having('users.id', '=', $id);

        if (array_key_exists('transaction', $params)) {
            $query->having('transaction', 'like', '%' . $params['transaction'] . '%');
            $subQuery->having('transaction', 'like', '%' . $params['transaction'] . '%');
            unset($params['transaction']);
        }

        if (array_key_exists('date_start', $params)) {
            $query->having('paid_at', '>=', Carbon::parse($params['date_start'])->startOfDay());
            $subQuery->having('paid_at', '>=', Carbon::parse($params['date_start'])->startOfDay());
            unset($params['date_start']);
        }

        if (array_key_exists('date_end', $params)) {
            $query->having('paid_at', '<=', Carbon::parse($params['date_end'])->endOfDay());
            $subQuery->having('paid_at', '<=', Carbon::parse($params['date_end'])->endOfDay());
            unset($params['date_end']);
        }

        foreach ($params as $field => $param) {
            $query->where($field, 'like', '%' . $param . '%');
            $subQuery->where($field, 'like', '%' . $param . '%');
        }

        return $query
            ->unionAll($subQuery)
            ->orderBy($orderBy, $sorting)
            ->paginate($perPage);
    }

    /**
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Builder
     * |\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getStatistic(array $relations = [])
    {
        $userId = auth()->guard('user')->user()->getId();

        return $this->model->with($relations)
                ->selectRaw('SUM(orders.amount) as usedBonuses')
                ->leftJoin('orders', 'orders.user_id', '=', 'users.id')
                ->where('users.id', '=', $userId)
                ->where('orders.status_id', '!=', Order::STATUS_CANCELED)
                ->first();
    }

    /**
     * @param $perPage
     * @param array $params
     * @param array $relations
     * @param string $orderBy
     * @param string $sorting
     * @return mixed
     */
    public function getPaginatorWithQueryParams(
        $perPage,
        array $params    = [],
        array $relations = [],
        string $orderBy  = 'created_at',
        string $sorting  = 'desc'
    ) {
        $query = $this->model->with($relations)
            ->select('users.*')
            ->leftJoin('orders', function ($join) {
                $join->on('orders.user_id', '=', 'users.id')
                    ->join('cart_products', 'cart_products.order_id', '=', 'orders.id')
                    ->join('products', 'products.id', '=', 'cart_products.product_id');
            });

        if (array_key_exists('outlet_ids', $params)) {
            $query = $query->whereIn('products.outlet_id', $params['outlet_ids']);
            unset($params['outlet_ids']);
        }

        foreach ($params as $field => $param) {
            $query->where($field, 'like', '%' . $param . '%');
        }

        return $query
            ->orderBy($orderBy, $sorting)
            ->distinct()
            ->paginate($perPage);
    }

    /**
     * @param array $conditions
     */
    public function countUsersByConditions(array $conditions)
    {
        $query = $this->model
            ->selectRaw(
                'SUM(users.id) as count_users'
            )
            ->leftJoin('orders', function ($join) {
                $join->on('orders.user_id', '=', 'users.id')
                    ->join('cart_products', 'cart_products.order_id', '=', 'orders.id')
                    ->join('products', 'products.id', '=', 'cart_products.product_id');
            });

        if (array_key_exists('outlet_ids', $conditions)) {
            $query = $query->whereIn('products.outlet_id', $conditions['outlet_ids']);
        }

        if (array_key_exists('date_start', $conditions)) {
            $query->whereDate('created_at', '>=', $conditions['date_start']);
        }

        if (array_key_exists('date_end', $conditions)) {
            $query->whereDate('created_at', '<=', $conditions['date_end']);
        }

        return $query->distinct()->first();
    }
}
