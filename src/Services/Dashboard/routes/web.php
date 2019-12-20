<?php

Route::group([
    'prefix' => \Framework\Http\Middleware\LocaleMiddleware::getPrefix(),
    'middleware' => ['web'],
    'as' => 'dashboard.'
], function () {

    /** Part of app that requires authentication. */
    Route::group(['prefix' => 'dashboard', 'middleware' => 'dashboard.auth'], function () {

        Route::get('/', 'StatisticController@index')->name('home');

        Route::get('/admins', 'AdminController@index')->name('admins.index')
            ->middleware('gate:admin,super_admin');
        Route::get('/admins/create', 'AdminController@create')->name('admins.create')
            ->middleware('gate:admin,super_admin');
        Route::get('/admins/{id}/edit', 'AdminController@edit')->name('admins.edit')
            ->middleware('gate:admin,super_admin');
        Route::get('/admins/{id}', 'AdminController@show')->name('admins.show')
            ->middleware('gate:admin,super_admin');
        Route::post('/admins/store', 'AdminController@store')->name('admins.store')
            ->middleware('gate:admin,super_admin');
        Route::put('/admins/{id}/update', 'AdminController@update')->name('admins.update')
            ->middleware('gate:admin,super_admin');
        Route::delete('/admins/{id}/delete', 'AdminController@destroy')->name('admins.destroy')
            ->middleware('gate:admin,super_admin');

        Route::get('/users', 'UserController@index')->name('users.index')
            ->middleware('gate:admin,super_admin');
        Route::get('/users/{id}/edit', 'UserController@edit')->name('users.edit')
            ->middleware('gate:admin,super_admin');
        Route::get('/users/{id}', 'UserController@show')->name('users.show')
            ->middleware('gate:admin,super_admin');
        Route::put('/users/{id}/update', 'UserController@update')->name('users.update')
            ->middleware('gate:admin,super_admin');
        Route::delete('/users/{id}/delete', 'UserController@destroy')->name('users.destroy')
            ->middleware('gate:admin,super_admin');

        Route::post('/logout', 'AuthController@logout')->name('auth.logout');

    });

    /** Part of app available for guest. */
    Route::group([
        'prefix' => 'dashboard',
        'middleware' => 'dashboard.!auth',
    ], function () {

        Route::get('/login', 'AuthController@login')->name('auth.login');
        Route::post('/authenticate', 'AuthController@authenticate')->name('auth.authenticate');


        Route::get('/password-recovery/{token}', 'AuthController@passwordRecovery')->name('auth.password-recovery');
        Route::post('/accept-password-recovery/{token}',
            'AuthController@acceptPasswordRecovery')->name('auth.accept-password-recovery');

    });

});
