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
Route::get('/', 'SignatoryController@listPetitions');


//TODO this should be more like a control panel
Route::get('/home', 'PetitionController@index');

Route::put('/petition/{id}/publish', [
    'as' => 'petition.publish', 'uses' => 'PetitionController@publish'
]);

Route::resource('petition', 'PetitionController');

Route::delete('/mediafile/{id}', [
    'as' => 'mediafile.destroy', 'uses' => 'PetitionController@destroyMediafile'
]);

Route::get('/petition/{id}/mediafiles', [
    'as' => 'petition.mediafiles', 'uses' => 'PetitionController@editMediaFiles'
]);

Route::get('/petition/{id}/signatures', [
    'as' => 'petition.signatures', 'uses' => 'PetitionController@signatures'
]);

Route::post('/petition/{id}/mediafile', [
    'as' => 'petition.storemediafile', 'uses' => 'PetitionController@storeMediaFile'
]);

Route::get('/petition/{id}/sign', [
   'as' => 'signatory.sign', 'uses' => 'SignatoryController@createSignature'
]);

Route::post('/petition/{id}/sign', [
    'as' => 'signatory.store', 'uses' => 'SignatoryController@storeSignature'
]);
