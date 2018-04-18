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

Route::get('/groups/{id}/exit', 'GroupController@exit');

Route::get('/groups/{id}/changeName','GroupController@showChangeName');

Route::post('/groups/{id}/changeName', 'GroupController@changeName')->name('changeGN');

Route::post('/groups/{id}', 'GroupController@addFriend')->name('my_route');

Route::get('/profile/{email}', 'FriendsController@viewFriend');

Route::get('/songs/{email}', 'FriendsController@viewFriendSongs');

Route::get('/friends','FriendsController@indexFriends');

Route::post('/friends', 'FriendsController@addFriend');

Route::get('/deleteFriend/{email}', 'FriendsController@deleteFriend');

Route::post('/deleteFriend', 'FriendsController@deleteF');

Route::get('/', 'RootController@show');

Route::post('/profile', 'UserController@login');

Route::get('/user/logout', 'UserController@logout');

Route::post('/user/signup', 'UserController@signup');

Route::post('/user/publicate', 'UserController@publicate');

Route::post('/user/publication/remove', 'UserController@removePublication');

Route::get('/profile', 'UserController@login');

Route::get('/settings', 'SettingsController@show');

Route::post('/user/update/info', 'SettingsController@update');

Route::post('/user/update/image', ['as'=>'user.update.image','uses'=>'SettingsController@updateImage']);
