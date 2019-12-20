<?php

namespace App\Services\Dashboard\Http\Controllers;

use Lucid\Foundation\Http\Controller;
use App\Services\Dashboard\Features\User\ShowUserFeature;
use App\Services\Dashboard\Features\User\UserListFeature;
use App\Services\Dashboard\Features\User\EditUserFeature;
use App\Services\Dashboard\Features\User\UpdateUserFeature;
use App\Services\Dashboard\Features\User\DeleteUserFeature;

/**
 * Class UserController
 * @package App\Services\Dashboard\Http\Controllers
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        view()->share('menuActive', 'users');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->serve(UserListFeature::class);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->serve(ShowUserFeature::class, [
            'userId' => (int)$id
        ]);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function edit($id)
    {
        return $this->serve(EditUserFeature::class, [
            'userId' => (int)$id
        ]);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function update($id)
    {
        return $this->serve(UpdateUserFeature::class, [
            'userId' => (int)$id
        ]);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->serve(DeleteUserFeature::class, [
            'userId' => (int)$id
        ]);
    }
}
