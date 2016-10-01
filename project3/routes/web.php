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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/projects', 'ProjectsController@index');

Route::get('/projects/{project}', 'ProjectsController@show');

Route::get('/projects/manage', 'ProjectsController@manage');

Route::post('/projects/manage/add', 'ProjectsController@store');



///////////////////*API's*///////////////////////////////////
Route::get('/api/projects', 'APIcontroller@allPorjectsAPI');

Route::get('/api/projects/{project}', 'APIcontroller@showOneProjectAPI');