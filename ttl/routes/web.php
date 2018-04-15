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

Route::get('/groups', 'GroupController@show');

Route::post('/groups', 'GroupController@createGroup');

Route::get('/groups/{id}', 'GroupController@groupPublications');

Route::get('/profile/{email}', 'FriendsController@viewFriend');

Route::get('/songs/{email}', 'FriendsController@viewFriendSongs');

Route::get('/friends','FriendsController@indexFriends');

Route::post('/friends', 'FriendsController@addFriend');

Route::get('/deleteFriend/{email}', 'FriendsController@deleteFriend');

Route::post('/deleteFriend', 'FriendsController@deleteF');