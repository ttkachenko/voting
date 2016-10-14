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



//Маршруты аутентификации...
Route::get('auth/login', 'MyAuthController@getLogin');
Route::post('auth/login', 'MyAuthController@postLogin');
Route::get('auth/logout', 'MyAuthController@getLogout');

// Маршруты регистрации...
Route::get('auth/register', 'MyAuthController@getRegister');
Route::post('auth/register', 'MyAuthController@postRegister');

Route::get('/', 'HomeController@index');