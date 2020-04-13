<?php

Route::view('/', 'welcome')->name('home');

// Statuses routes
Route::get('statuses', 'StatusController@index')->name('statuses.index');
Route::post('statuses', 'StatusController@store')->name('statuses.store')->middleware('auth');
// Route::resource('status', 'StatusController');

// Statuses likes routes
Route::post('statuses/{status}/likes', 'StatusLikesController@store')->name('statuses.likes.store')->middleware('auth');
Route::delete('statuses/{status}/likes', 'StatusLikesController@destroy')->name('statuses.likes.destroy')->middleware('auth');

// Statuses comments routes
Route::post('statuses/{status}/comments', 'StatusCommentsController@store')->name('statuses.comments.store')->middleware('auth');

// Comments likes routes
Route::post('comments/{comment}/likes', 'CommentLikesController@store')->name('comments.likes.store')->middleware('auth');
Route::delete('comments/{comment}/likes', 'CommentLikesController@destroy')->name('comments.likes.destroy')->middleware('auth');

// User routes
Route::get('@{user}', 'UserController@show')->name('users.show');

// User statuses routes
Route::get('users/{user}/statuses', 'UsersStatusController@index')->name('users.statuses.index');

// Friendships routes
Route::post('friendships/{recipient}', 'FriendshipsController@store')->name('friendships.store')->middleware('auth');
Route::delete('friendships/{user}', 'FriendshipsController@destroy')->name('friendships.destroy')->middleware('auth');

// Accept friendships routes
Route::get('friends/requests', 'AcceptFriendshipsController@index')->name('accept-friendships.index');
Route::post('accept-friendships/{sender}', 'AcceptFriendshipsController@store')->name('accept-friendships.store')->middleware('auth');
Route::delete('accept-friendships/{sender}', 'AcceptFriendshipsController@destroy')->name('accept-friendships.destroy')->middleware('auth');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
