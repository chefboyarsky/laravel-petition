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

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::auth();
//TODO this should be some sort of public index
Route::get('/', 'PetitionController@list');


//TODO this should be more like a control panel
Route::get('/home', 'PetitionController@index');
Route::put('/petition/{id}/publish', [
    'as' => 'petition.publish', 'uses' => 'PetitionController@publish'
]);
Route::resource('petition', 'PetitionController');

Route::get('/petition/{id}/mediafiles', [
    'as' => 'petition.mediafiles', 'uses' => 'PetitionController@editMediaFiles'
]);
Route::post('/petition/{id}/mediafile', [
    'as' => 'petition.storemediafile', 'uses' => 'PetitionController@storeMediaFile'
]);
