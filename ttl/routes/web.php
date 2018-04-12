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

Route::get('/', function () {
    //return view('welcome');
    return view('loginsignup', ["title" => "Time to Listen"]);
});

Route::get('/profile', function () {
    return view('user.profile');
});

Route::get('/songs', function () {
    return view('user.songs');
});