<?php

use Illuminate\Support\Facades\Route;

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

    Route::get('/projects', 'ProjectsController@index');        //dashboard route
    Route::get('/projects/create', 'ProjectsController@create');        //
    Route::get('/projects/{project}', 'ProjectsController@show');       //dashboard to show a project
    Route::post('/projects', 'ProjectsController@store');           //route that persists the project to the database

    Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();


