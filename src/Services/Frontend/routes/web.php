<?php

Route::group([
    'prefix'     => \Framework\Http\Middleware\LocaleMiddleware::getPrefix(),
    'middleware' => ['web'],
    'as'         => 'frontend.'
], function () {

    /** Part of app that requires authentication. */
    Route::group(['prefix' => 'frontend', 'middleware' => 'frontend.auth'], function () {

        Route::get('/', 'StatisticController@index')->name('home');

        Route::post('/logout', 'AuthController@logout')->name('auth.logout');

    });

    /** Part of app available for guest. */
    Route::group([
        'prefix'     => 'frontend',
        'middleware' => 'frontend.!auth',
    ], function () {

        Route::get('/login',         'AuthController@login')->name('auth.login');
        Route::post('/authenticate', 'AuthController@authenticate')->name('auth.authenticate');

        Route::get('/register',      'AuthController@register')->name('auth.register');
        Route::post('/registration', 'AuthController@registration')->name('auth.registration');

        Route::get('/password-recovery/{token}', 'AuthController@passwordRecovery')->name('auth.password-recovery');
        Route::post('/accept-password-recovery/{token}',
            'AuthController@acceptPasswordRecovery')->name('auth.accept-password-recovery');

        Route::get('/password-recovery-request',
            'AuthController@passwordRecoveryRequest')->name('auth.password-recovery-request');
        Route::post('/accept-password-recovery-request',
            'AuthController@acceptPasswordRecoveryRequest')->name('auth.accept-password-recovery-request');

    });

});
