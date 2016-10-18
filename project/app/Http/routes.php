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




Route::get('auth/login', 'MyAuthController@getLogin');
Route::post('auth/login', 'MyAuthController@postLogin');

Route::get('auth/register', 'MyAuthController@getRegister');
Route::post('auth/register', 'MyAuthController@postRegister');

Route::get('auth/logout', 'MyAuthController@getLogout');

Route::post('votesAllPeople', 'VoteController@votesAllPeople');
Route::post('voteToMan', 'VoteController@voteToMan');
Route::post('getHistoryVotes', 'VoteController@getHistoryVotes');

Route::post('getComments', 'CommentController@getComments');
Route::post('addComment', 'CommentController@addComment');

Route::get('info/{userId}', 'UserController@info');
Route::get('edit', 'UserController@getEdit');
Route::post('edit', 'UserController@postEdit');


Route::get('/', 'HomeController@index');