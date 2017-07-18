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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

// Routing backend administrator
$router->group([
    'namespace'  => 'Backend',
    'prefix'     => config('larakuy.prefix_admin', 'backend'), 
    'as'         => 'backend::',
    'middleware' => 'auth'
    ], function ($router) {
    
    // Dashboard
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
});
