<?php

namespace App\Services\Dashboard\Http\Controllers;

use Lucid\Foundation\Http\Controller;
use App\Services\Dashboard\Features\Admin\ShowAdminFeature;
use App\Services\Dashboard\Features\Admin\EditAdminFeature;
use App\Services\Dashboard\Features\Admin\AdminsListFeature;
use App\Services\Dashboard\Features\Admin\StoreAdminFeature;
use App\Services\Dashboard\Features\Admin\DeleteAdminFeature;
use App\Services\Dashboard\Features\Admin\CreateAdminFeature;
use App\Services\Dashboard\Features\Admin\UpdateAdminFeature;

/**
 * Class AdminController
 * @package App\Services\Dashboard\Http\Controllers
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class AdminController extends Controller
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        view()->share('menuActive', 'admins');
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->serve(AdminsListFeature::class);
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return $this->serve(CreateAdminFeature::class);
    }

    /**
     * @return mixed
     */
    public function store()
    {
        return $this->serve(StoreAdminFeature::class);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->serve(ShowAdminFeature::class, [
            'adminId' => (int)$id
        ]);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function edit($id)
    {
        return $this->serve(EditAdminFeature::class, [
            'adminId' => (int)$id
        ]);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function update($id)
    {
        return $this->serve(UpdateAdminFeature::class, [
            'adminId' => (int)$id
        ]);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->serve(DeleteAdminFeature::class, [
            'adminId' => (int)$id
        ]);
    }
}
