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

Route::get('/home', 'HomeController@index');

Route::get('/projects/manage', 'ProjectsController@manage');

Route::post('/projects/manage/add', 'ProjectsController@store');

Route::get('/projects/{project}/delete', 'ProjectsController@delete');

Route::post('/reactions/{project}/add', 'ReactionsController@store');

///////////////////*API's*///////////////////////////////////

Route::get('/api/projects', 'APIcontroller@allPorjectsAPI');

Route::get('/api/projects/{project}', 'APIcontroller@showOneProjectAPI');

Route::get('/api/projects/filter/{isCompany}/{isPriority}', 'APIcontroller@fiterProjects');