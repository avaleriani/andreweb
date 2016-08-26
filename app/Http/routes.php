<?php
//Front

use Illuminate\Support\Facades\Route;

Route::get('/', 'PagesController@home')->name('home');
Route::get('/', 'PagesController@archive')->name('archive');


//backoffice
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => ['auth', 'acl']], function () {
        Route::get('/', ['uses' => 'AdminController@admin_index', 'roles' => ['admin']])->name('adminIndex');
        Route::get('logout', ['uses' => 'UsersController@doLogout', 'roles' => ['admin']])->name('logout');


        //Users
        Route::get('/users', ['uses' => 'UsersController@index', 'roles' => ['admin']])->name('admin.users.index');
        Route::get('/users/show', ['uses' => 'UsersController@show', 'roles' => ['admin']])->name('admin.users.show');
        Route::get('/users/create', ['uses' => 'UsersController@create', 'roles' => ['admin']])->name('admin.users.create');
        Route::post('/users/store', ['uses' => 'UsersController@store', 'roles' => ['admin']])->name('admin.users.store');
        Route::get('/users/{id}/edit', ['uses' => 'UsersController@edit', 'roles' => ['admin']])->name('admin.users.edit');
        Route::put('/users/{id}', ['uses' => 'UsersController@update', 'roles' => ['admin']])->name('admin.users.update');
        Route::delete('/users/{id}', ['uses' => 'UsersController@destroy', 'roles' => ['admin']])->name('admin.users.destroy');

        //Projects images
        Route::get('/projectImage/{id}', ['uses' => 'ProjectsImagesController@index', 'roles' => ['admin']])->name('admin.projectsImages.index');
        Route::get('/projectImage/create/{id}', ['uses' => 'ProjectsImagesController@create', 'roles' => ['admin']])->name('admin.projectsImages.create');
        Route::get('/projectImage/{id}/edit', ['uses' => 'ProjectsImagesController@edit', 'roles' => ['admin']])->name('admin.projectsImages.edit');
        Route::post('imagen/imagen', ['uses' => 'ProjectsImagesController@subirImagen'])->name('subirImagen');
        Route::post('edit/order/imagen', ['uses' => 'ProjectsImagesController@cambiarOrdenImagen'])->name('cambiarOrdenImagen');
        Route::post('imagen/delete', ['uses' => 'ProjectsImagesController@borrarImagen'])->name('borrarImagen');


        //Projects
        Route::get('/projects', ['uses' => 'ProjectsController@index', 'roles' => ['admin']])->name('admin.projects.index');
        Route::get('/projects/create', ['uses' => 'ProjectsController@create', 'roles' => ['admin']])->name('admin.projects.create');
        Route::post('/projects/store', ['uses' => 'ProjectsController@store', 'roles' => ['admin']])->name('admin.projects.store');
        Route::get('/projects/{id}/edit', ['uses' => 'ProjectsController@edit', 'roles' => ['admin']])->name('admin.projects.edit');
        Route::put('/projects/{id}', ['uses' => 'ProjectsController@update', 'roles' => ['admin']])->name('admin.projects.update');
        Route::delete('/projects/{id}', ['uses' => 'ProjectsController@destroy', 'roles' => ['admin']])->name('admin.projects.destroy');
    });

    Route::get('login', 'UsersController@login')->name('login');
    Route::post('login', 'UsersController@doLogin')->name('doLogin');
});