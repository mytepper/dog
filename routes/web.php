<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::any('image/{path}/{image_name}', 'Controller@showImage');

Route::any('/', 'UserController@login');
Route::any('register', 'UserController@register');
Route::any('forget_password', 'UserController@forgetPassword');
Route::any('login', 'UserController@login')->name('login');

Route::prefix('dog')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/', 'DogController@index');
        Route::get('logout', 'UserController@logout');

        Route::get('provinces', 'ApplicationController@provinces');
        Route::get('district/{province_id}', 'ApplicationController@getDistricts');

        Route::get('user/profile/{user_id}', 'UserController@profile');
        Route::any('user/update', 'UserController@update');

        Route::get('/', 'DogController@store');
        Route::get('store', 'DogController@store');
        Route::get('index', 'DogController@index');
        Route::any('create', 'DogController@create');
        Route::any('update/{dog_id}', 'DogController@update');
        Route::get('delete/{dog_id}', 'DogController@delete');
        Route::get('detail/{dog_id}', 'DogController@detail');

        Route::get('condition/index', 'ConditionController@index');
        Route::get('condition/create', 'ConditionController@create');
        Route::get('condition/update/{condition_id}', 'ConditionController@update');
        Route::get('condition/delete/{condition_id}', 'ConditionController@delete');
    });
});
