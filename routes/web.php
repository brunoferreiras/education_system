<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Auth::routes();

    Route::group([
        'namespace' => 'Admin\\',
        'as' => 'admin.',
        'middleware' => ['auth', 'can:admin'],
    ], function () {
        Route::name('dashboard')->get('/dashboard', function () {
            return 'Estou no dashboard';
        });
        Route::group(['prefix' => 'users', 'as' => 'users.'], function() {
            Route::name('show_details')->get('show_details', 'UsersController@showDetails');
        });
        Route::resource('users', 'UsersController');
    });
});

Route::get('/home', 'HomeController@index')->name('home');
