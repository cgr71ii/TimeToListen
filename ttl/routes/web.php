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

Route::post('/user/publicate', 'UserController@publicate');

//Route::get('/profile', function () {
    //return view('user.profile');
//});

Route::get('/profile', 'UserController@login');