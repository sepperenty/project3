<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'PublicController@index');

Route::get('/projects/{project}/show', 'PublicController@show');

Route::get('/pictures/add', "PictureController@add");

Route::post('/pictures/store', "PictureController@store");

Auth::routes();

Route::get('/projects/add', 'ProjectsController@add');

Route::get('/projects/beheer', 'ProjectsController@manage');

Route::get('/projects/{project}/edit', 'ProjectsController@edit');

Route::post('/projects/add/new', 'ProjectsController@store');

Route::get('/projects/{project}/delete', 'ProjectsController@delete');

Route::post('/reactions/{project}/add', 'ReactionsController@store');

////////////////////ADMIN///////////////////////////////////

Route::get('/admin/users', 'AdminController@users');

Route::get('/admin/{user}/delete', 'AdminController@deleteUser');

Route::get('/admin/{user}/projects', 'AdminController@projects');

Route::get('/admin/project/{project}/delete', "AdminController@delete");

///////////////////*API's*///////////////////////////////////

Route::get('/api/projects', 'APIcontroller@allPorjectsAPI');

Route::get('/api/projects/{project}', 'APIcontroller@showOneProjectAPI');

Route::get('/api/projects/filter/{key}', 'APIcontroller@fiterProjects');