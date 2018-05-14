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

Route::get('/groups', 'GroupController@show')->middleware('auth');

Route::post('/groups/create', 'GroupController@createGroup')->middleware('auth');

Route::get('/groups/publications', 'GroupController@groupPublications')->middleware('auth');

Route::post('/groups/{id}/exit', 'GroupController@exit')->middleware('auth');

Route::get('/groups/{id}/changeName','GroupController@showChangeName')->middleware('auth');

Route::post('/groups/updateName', 'GroupController@updateOnlyName')->middleware('auth');

Route::post('/groups/add/{id}', 'GroupController@addFriend')->name('my_route')->middleware('auth');

Route::post('/group/remove', 'GroupController@delete')->middleware('auth');

Route::get('/friends','FriendsController@show')->middleware('auth');

Route::post('/friends', 'FriendsController@addFriend')->middleware('auth');

Route::get('/deleteFriend/{email}', 'FriendsController@deleteFriend')->middleware('auth');

Route::post('/deleteFriend', 'FriendsController@deleteF')->middleware('auth');

Route::get('/', ['as' => 'login', 'uses' => 'RootController@show'])->middleware('notauth');

Route::post('/profile', 'UserController@showAfterLogin');

Route::get('/profile/{friend_email}', 'UserController@showFriend')->middleware('auth');

Route::get('/user/logout', 'UserController@logout')->middleware('auth');

Route::post('/user/signup', 'UserController@signup')->middleware('notauth');

Route::post('/user/publication/remove', 'PublicationController@delete')->middleware('auth');

Route::get('/profile', 'UserController@show')->middleware('auth');

Route::get('/settings', 'UserController@showSettings')->middleware('auth');

Route::post('/user/update/info', 'UserController@update')->middleware('auth');

Route::post('/user/publication/modify', 'UserController@modifyPublication')->middleware('auth');

Route::post('/user/update/image', ['as'=>'user.update.image','uses'=>'UserController@updateImage'])->middleware('auth');

Route::post('/user/remove', 'UserController@remove')->middleware('auth');

Route::get('/list/users', 'UserController@listUsers')->middleware('auth');

Route::get('/list/genres', 'GenreController@listGenres')->middleware('auth');

Route::get('/list/songs', 'SongController@listSongs')->middleware('auth');

Route::get('/list/groups', 'GroupController@listGroups')->middleware('auth');

Route::get('/list/messages', 'MessageController@listMessages')->middleware('auth');

Route::get('/list/publications', 'PublicationController@listPublications')->middleware('auth');

Route::post('/genres/update', 'GenreController@update')->middleware('auth');

Route::post('/genres/remove', 'GenreController@remove')->middleware('auth');

Route::post('/user/publicate', 'PublicationController@create')->middleware('auth');

Route::post('/user/publication/remove', 'PublicationController@delete')->middleware('auth');

Route::get('/messages', 'MessageController@show')->middleware('auth');

Route::get('/messages/sent', 'MessageController@listSentMessages')->middleware('auth');

Route::get('/messages/received', 'MessageController@listReceivedMessages')->middleware('auth');

Route::post('/messages/received/remove', 'MessageController@delete')->middleware('auth');

Route::get('/songs', 'SongController@show')->middleware('auth');

Route::post('/song/add_song', ['as'=>'song.add_song','uses'=>'SongController@add_song'])->middleware('auth');

Route::post('/user/song/remove', 'SongController@removeSong')->middleware('auth');

Route::post('/song/update', 'SongController@update')->middleware('auth');

Route::get('/messages/send', 'MessageController@send')->middleware('auth');

Route::post('/message/send/create', 'MessageController@create')->middleware('auth');
