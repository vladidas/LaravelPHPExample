<?php

namespace App\Services\Dashboard\database\seeds;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class CreateAdmin
 * @package App\Services\Dashboard\database\seeds
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class CreateAdmin extends Seeder
{
    /**
     * Create admin
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admins')->insert([
            'name'       => env('DB_ADMIN_NAME'),
            'surname'    => env('DB_ADMIN_SURNAME'),
            'email'      => env('DB_ADMIN_EMAIL'),
            'role_id'    => env('DB_ADMIN_ROLE_ID'),
            'password'   => Hash::make(env('DB_ADMIN_PASSWORD')),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
