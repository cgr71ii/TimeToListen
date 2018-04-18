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

Route::post('/profile', 'UserController@login');

Route::get('/user/logout', 'UserController@logout');

Route::post('/user/signup', 'UserController@signup');



Route::get('/profile', 'UserController@login');

Route::get('/settings', 'SettingsController@show');

Route::post('/user/update/info', 'SettingsController@update');

Route::post('/user/update/image', ['as'=>'user.update.image','uses'=>'SettingsController@updateImage']);


// Rutas añadidas o modificadas

Route::post('/user/publicate', 'PublicationController@create');

Route::post('/user/publication/remove', 'PublicationController@delete');

Route::get('/messages', 'MessageController@index');

Route::get('/messages/received', 'MessageController@list');

Route::post('/messages/received/remove', 'MessageController@delete');

Route::get('/messages/send', 'MessageController@send');

Route::post('/message/send/create', 'MessageController@create');