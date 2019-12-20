<?php

namespace App\Services\Dashboard\database\seeds;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class CreateUser
 * @package App\Services\Dashboard\database\seeds
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class CreateUser extends Seeder
{
    /**
     * Create admin
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name'       => env('DB_USER_NAME'),
            'surname'    => env('DB_USER_SURNAME'),
            'email'      => env('DB_USER_EMAIL'),
            'phone'      => env('DB_USER_PHONE'),
            'bonuses'    => env('DB_USER_BONUSES'),
            'password'   => Hash::make(env('DB_USER_PASSWORD')),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
