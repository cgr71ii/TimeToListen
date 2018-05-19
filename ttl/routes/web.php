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

Route::get('/groups', 'GroupController@show');

Route::post('/groups/create', 'GroupController@createGroup');

Route::get('/groups/publications', 'GroupController@groupPublications');

Route::post('/groups/{id}/exit', 'GroupController@exit');

Route::get('/groups/{id}/changeName','GroupController@showChangeName');

Route::post('/groups/updateName', 'GroupController@updateOnlyName');

Route::post('/groups/add/{id}', 'GroupController@addFriend')->name('my_route');

Route::post('/group/remove', 'GroupController@delete');

Route::get('/friends','FriendsController@show');

Route::post('/friends', 'FriendsController@addFriend');

Route::post('/deleteFriend', 'FriendsController@deleteF');

Route::get('/', function(){
    return view('home');
});

Route::get('/loginsignup', function(){
    return view('loginsignup');
});

Route::get('/information', function(){
    return view('information');
});

Route::get('/contact', function(){
    return view('contact');
});

Route::post('/sendemail','MailController@sendContactEmail');

Route::post('/profile', 'UserController@show');

Route::get('/profile/{friend_email}', 'UserController@showFriend');

Route::get('/user/logout', 'UserController@logout');

Route::post('/user/signup', 'UserController@signup');

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

Route::get('/list/groups', 'GroupController@listGroups');

Route::get('/list/messages', 'MessageController@listMessages');

Route::get('/list/publications', 'PublicationController@listPublications');

Route::post('/genres/update', 'GenreController@update');

Route::post('/genres/remove', 'GenreController@remove');

Route::post('/user/publicate', 'PublicationController@create');

Route::post('/user/publication/remove', 'PublicationController@delete');

Route::get('/messages', 'MessageController@show');

Route::get('/messages/sent', 'MessageController@listSentMessages');

Route::get('/messages/received', 'MessageController@listReceivedMessages');

Route::post('/messages/received/remove', 'MessageController@delete');

Route::get('/songs', 'SongController@show');

Route::post('/song/add_song', ['as'=>'song.add_song','uses'=>'SongController@add_song']);

Route::post('/user/song/remove', 'SongController@removeSong');

Route::post('/song/update', 'SongController@update');

Route::get('/messages/send', 'MessageController@send');

Route::post('/message/send/create', 'MessageController@create');
