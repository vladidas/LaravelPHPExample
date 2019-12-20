<?php

namespace App\Services\Frontend\Http\Controllers;

use Lucid\Foundation\Http\Controller;

/**
 * Class UserController
 * @package App\Services\Frontend\Http\Controllers
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
}
