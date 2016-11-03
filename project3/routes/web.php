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
Auth::routes();

Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');

Route::post('/contact/send', 'PublicController@sendContactMail');

Route::get('/', 'PublicController@index');

Route::get('/projects/{project}/show', 'PublicController@show');

Route::get('/pictures/add', "PictureController@add");

Route::post('/pictures/store', "PictureController@store");


Route::get('/projects/add', 'ProjectsController@add');

Route::get('/projects/beheer', 'ProjectsController@manage');

Route::get('/projects/{project}/edit', 'ProjectsController@edit');

Route::post('/projects/{project}/update', 'ProjectsController@update');

Route::post('/projects/add/new', 'ProjectsController@store');

Route::get('/projects/{project}/delete', 'ProjectsController@delete');

Route::post('/projects/{project}/mail', 'MailController@sendProjectMail');

////////////////////ADMIN///////////////////////////////////

Route::get('/admin/users', 'AdminController@users');

Route::get('/admin/pictures', "AdminController@pictures");

Route::get('/admin/picture/{picture}/delete', "AdminController@deletePicture");

Route::get('/admin/{user}/delete', 'AdminController@deleteUser');

Route::get('/admin/{user}/projects', 'AdminController@projects');

Route::get('/admin/project/{project}/delete', "AdminController@delete");

///////////////////*API's*///////////////////////////////////

Route::get('/api/projects', 'APIcontroller@allPorjectsAPI');

Route::get('/api/projects/{project}', 'APIcontroller@showOneProjectAPI');

Route::get('/api/projects/filter/{key}', 'APIcontroller@fiterProjects');