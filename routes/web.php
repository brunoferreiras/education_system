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

    Route::group(['prefix' => 'users', 'as' => 'admin.users.'], function() {
        Route::name('settings.edit')->get('settings', 'Admin\UserSettingsController@edit');
        Route::name('settings.update')->put('settings', 'Admin\UserSettingsController@update');
    });

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
            Route::group(['prefix' => '/{user}/profile'], function() {
                Route::name('profile.edit')->get('','UserProfileController@edit');
                Route::name('profile.update')->put('','UserProfileController@update');
            });
        });
        Route::resource('users', 'UsersController');
        Route::resource('subjects', 'SubjectsController');
        Route::group(['prefix' => 'class_informations/{class_information}', 'as' => 'class_informations.'], function() {
            Route::resource('students', 'ClassStudentsController', ['only' => ['index', 'store', 'destroy']]);
            Route::resource('teachings', 'ClassTeachingsController', ['only' => ['index', 'store', 'destroy']]);
        });
        Route::resource('class_informations', 'ClassInformationsController');
    });

    Route::group([
        'namespace' => 'Api\\',
        'as' => 'admin.api',
        'middleware' => ['auth', 'can:admin'],
        'prefix' => 'api'
    ], function () {
        Route::name('students.index')->get('students', 'StudentsController@index');
        Route::name('subjects.index')->get('subjects','SubjectsController@index');
        Route::name('teachers.index')->get('teachers','TeachersController@index');
    });
});

Route::get('/home', 'HomeController@index')->name('home');
