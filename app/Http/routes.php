<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::auth();

Route::get('/home', 'PetitionController@index');
Route::put('/petition/{id}/publish', [
    'as' => 'petition.publish', 'uses' => 'PetitionController@publish'
]);
Route::resource('petition', 'PetitionController');
//Route::get('/petition', 'CustomerController@petition');
//Route::post('/petition', 'CustomerController@petition');
