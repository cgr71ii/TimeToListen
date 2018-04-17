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

Route::get('/', 'RootController@show');

Route::post('/profile', 'UserController@show');

Route::get('/profile/{friend_email}', 'UserController@showFriend');

Route::get('/user/logout', 'UserController@logout');

Route::post('/user/signup', 'UserController@signup');

Route::post('/user/publicate', 'UserController@publicate');

Route::post('/user/publication/remove', 'UserController@removePublication');

Route::get('/profile', 'UserController@show');

Route::get('/settings', 'SettingsController@show');

Route::post('/user/update/info', 'SettingsController@update');

Route::post('/user/publication/modify', 'UserController@modifyPublication');

Route::post('/user/update/image', ['as'=>'user.update.image','uses'=>'SettingsController@updateImage']);

Route::post('/user/remove', 'UserController@remove');

Route::get('/list/users', 'UserController@listUsers');

Route::get('/list/genres', 'GenreController@listGenres');

Route::post('/genres/update', 'GenreController@update');

Route::post('/genres/remove', 'GenreController@remove');