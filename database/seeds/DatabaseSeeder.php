<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(\App\Services\Dashboard\database\seeds\CreateAdmin::class);
         $this->call(\App\Services\Frontend\database\seeds\CreateUser::class);
    }
}
