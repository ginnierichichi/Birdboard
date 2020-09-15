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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'auth'], function () {

// Below are the 7 restful actions
//    Route::get('/projects', 'ProjectsController@index');        //dashboard route
//    Route::get('/projects/create', 'ProjectsController@create');        //
//    Route::get('/projects/{project}', 'ProjectsController@show');       //dashboard to show a project
//    Route::get('/projects/{project}/edit', 'ProjectsController@edit');
//    Route::patch('/projects/{project}', 'ProjectsController@update');
//    Route::post('/projects', 'ProjectsController@store');       //route that persists the project to the database
//    Route::delete('/projects/{project}', 'ProjectsController@destroy');

    Route::resource('projects', 'ProjectsController');

    Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
    Route::patch('/projects/{project}/tasks/{task}', 'ProjectTasksController@update'); //listen for a patch request & fetch tasks
    Route::post('/projects/{project}/invitations', 'ProjectInvitationsController@store');
    Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();


