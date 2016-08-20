<?php
//Front

use Illuminate\Support\Facades\Route;

Route::get('/', 'PagesController@home')->name('home');


//backoffice
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => ['auth', 'acl']], function () {
        Route::get('/', ['uses' => 'AdminController@admin_index', 'roles' => ['admin', 'sede', 'zona', 'punto']])->name('adminIndex');
        Route::get('logout', ['uses' => 'UsersController@doLogout', 'roles' => ['admin', 'sede', 'zona', 'punto']])->name('logout');


        //Users
        Route::get('/users', ['uses' => 'UsersController@index', 'roles' => ['admin', 'sede']])->name('admin.users.index');
        Route::get('/users/create', ['uses' => 'UsersController@create', 'roles' => ['admin', 'sede']])->name('admin.users.create');
        Route::post('/users/store', ['uses' => 'UsersController@store', 'roles' => ['admin', 'sede']])->name('admin.users.store');
        Route::get('/users/{id}/edit', ['uses' => 'UsersController@edit', 'roles' => ['admin', 'sede']])->name('admin.users.edit');
        Route::put('/users/{id}', ['uses' => 'UsersController@update', 'roles' => ['admin', 'sede']])->name('admin.users.update');
        Route::delete('/users/{id}', ['uses' => 'UsersController@destroy', 'roles' => ['admin', 'sede']])->name('admin.users.destroy');
    });

    Route::get('login', 'UsersController@login')->name('login');
    Route::post('login', 'UsersController@doLogin')->name('doLogin');
});