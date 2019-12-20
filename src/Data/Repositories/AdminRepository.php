<?php

namespace App\Data\Repositories;

use App\Data\Models\Admin;

/**
 * Class AdminRepository
 * @package App\Data\Repositories
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class AdminRepository extends Repository
{
    /**
     * AdminRepository constructor.
     * @param Admin $admin
     */
    public function __construct(Admin $admin)
    {
        parent::__construct($admin);
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
            ->select('admins.*');

        if (array_key_exists('outlet_ids', $params)) {
            $query->join('outlets_admins', function ($join) use ($params) {
                $join->on('outlets_admins.admin_id', '=', 'admins.id')
                    ->whereIn('outlets_admins.outlet_id', $params['outlet_ids']);
            });

            unset($params['outlet_ids']);
        }

        if (array_key_exists('role_id', $params)) {
            $query->where('admins.role_id', $params['role_id']);
            unset($params['role_id']);
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
 * @param int $adminId
 * @return mixed
 */
    public function findByAdminIdWithOutletsList(int $adminId)
    {
        return $this->model
            ->selectRaw(
                'admins.*, ' .
                'GROUP_CONCAT(DISTINCT outlet_translations.name SEPARATOR \', \') AS outlets_name'
            )
            ->leftJoin('outlets_admins', function ($join) {
                $join->on('outlets_admins.admin_id', 'admins.id')
                    ->join('outlets', 'outlets.id', '=', 'outlets_admins.outlet_id')
                    ->join('outlet_translations', 'outlet_translations.outlet_id', '=', 'outlets.id')
                    ->where('outlet_translations.locale', app()->getLocale());
            })
            ->groupBy('id')
            ->where('admins.id', $adminId)
            ->first();
    }

    /**
     * @param $outletIds
     * @return mixed
     */
    public function getAdminsFromHisOutletsByOutletIds($outletIds)
    {
        return $this->model
            ->select('admins.*')
            ->leftJoin('outlets_admins', 'outlets_admins.admin_id', '=', 'admins.id')
            ->whereIn('outlets_admins.outlet_id', $outletIds)
            ->distinct()
            ->get();
    }

    /**
     * @return mixed
     */
    public function getAdminsList()
    {
        return $this->model
            ->where('role_id', Admin::ROLE_ADMIN)
            ->get();
    }

    /**
     * @return mixed
     */
    public function getSellersList()
    {
        return $this->model
            ->where('role_id', Admin::ROLE_SELLER)
            ->get();
    }
}
