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

    // Periode
    $router->group([
        'prefix'     => 'periode', 
        'as'         => 'periode.',
        // 'middleware' => ['role:superadmin']
        ], function ($router) {
            Route::get('/', 'PeriodeController@index')->name('index');
            Route::get('/create', 'PeriodeController@create')->name('create');
            Route::post('/create', 'PeriodeController@store')->name('store');
            Route::get('/{id}', 'PeriodeController@show')->name('show');
            Route::get('/{id}/edit', 'PeriodeController@edit')->name('edit');
            Route::patch('/{id}/edit', 'PeriodeController@update')->name('update');
            Route::delete('/{id}/delete', 'PeriodeController@destroy')->name('destroy');
    });

    // Project
    $router->group([
        'prefix'     => 'project', 
        'as'         => 'project.',
        // 'middleware' => ['role:superadmin']
        ], function ($router) {
            Route::get('/', 'ProjectController@index')->name('index');
            Route::get('/create', 'ProjectController@create')->name('create');
            Route::post('/create', 'ProjectController@store')->name('store');
            Route::get('/{id}', 'ProjectController@show')->name('show');
            Route::get('/{id}/edit', 'ProjectController@edit')->name('edit');
            Route::patch('/{id}/edit', 'ProjectController@update')->name('update');
            Route::delete('/{id}/delete', 'ProjectController@destroy')->name('destroy');
    });

    // Project
    $router->group([
        'prefix'     => 'logbook', 
        'as'         => 'logbook.',
        // 'middleware' => ['role:superadmin']
        ], function ($router) {
            Route::get('/', 'LogbookController@index')->name('index');
            Route::get('/create', 'LogbookController@create')->name('create');
            Route::post('/create', 'LogbookController@store')->name('store');
            Route::get('/{id}', 'LogbookController@show')->name('show');
            Route::get('/{id}/edit', 'LogbookController@edit')->name('edit');
            Route::patch('/{id}/edit', 'LogbookController@update')->name('update');
            Route::delete('/{id}/delete', 'LogbookController@destroy')->name('destroy');
    });

    Route::get('/about', 'HomeController@about')->name('about');
    Route::get('/about2', 'HomeController@about')->name('about2');
});
