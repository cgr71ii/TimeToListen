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

Route::get('/songs', function () {
    return view('user.songs');
});

Route::get('/', 'RootController@show');

Route::post('/profile', 'UserController@show');

Route::get('/profile/{friend_email}', 'UserController@showFriend');

Route::get('/user/logout', 'UserController@logout');

Route::post('/user/signup', 'UserController@signup');

Route::post('/user/publicate', 'PublicationController@create');

Route::post('/user/publication/remove', 'PublicationController@delete');

Route::get('/profile', 'UserController@show');

Route::get('/settings', 'UserController@showSettings');

Route::post('/user/update/info', 'UserController@update');

Route::post('/user/publication/modify', 'UserController@modifyPublication');

Route::post('/user/update/image', ['as'=>'user.update.image','uses'=>'UserController@updateImage']);

Route::post('/user/remove', 'UserController@remove');

Route::get('/list/users', 'UserController@listUsers');

Route::get('/list/genres', 'GenreController@listGenres');

Route::get('/list/songs', 'SongController@listSongs');

Route::post('/genres/update', 'GenreController@update');

Route::post('/genres/remove', 'GenreController@remove');

Route::get('/messages', 'MessageController@index');

Route::get('/messages/received', 'MessageController@list');

Route::post('/messages/received/remove', 'MessageController@delete');

Route::get('/songs', 'SongController@songs');

Route::post('/song/add_song', ['as'=>'song.add_song','uses'=>'SongController@add_song']);

Route::post('/user/song/remove', 'SongController@removeSong');

//Route::post('/song/remove', 'SongController@removeSong');

Route::post('/song/update', 'SongController@update');