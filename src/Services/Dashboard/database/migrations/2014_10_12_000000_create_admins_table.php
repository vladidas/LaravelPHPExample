<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateAdminsTable
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('surname');
            $table->tinyInteger('role_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('can_edit_admin')->nullable();
            $table->boolean('can_delete_admin')->nullable();
            $table->boolean('send_letters')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admins');
    }
}
