<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

// Statuses routes
Route::get('statuses', 'StatusController@index')->name('statuses.index');
Route::get('statuses/{status}', 'StatusController@show')->name('statuses.show');
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
Route::get('friends/requests', 'AcceptFriendshipsController@index')->name('accept-friendships.index')->middleware('auth');
Route::post('accept-friendships/{sender}', 'AcceptFriendshipsController@store')->name('accept-friendships.store')->middleware('auth');
Route::delete('accept-friendships/{sender}', 'AcceptFriendshipsController@destroy')->name('accept-friendships.destroy')->middleware('auth');

// Notification routes
Route::get('notifications', 'NotificationsController@index')->name('notifications.index')->middleware('auth');

// Read Notification routes
Route::post('read-notifications/{notification}', 'ReadNotificationsController@store')->name('read-notifications.store')->middleware('auth');
Route::delete('read-notifications/{notification}', 'ReadNotificationsController@destroy')->name('read-notifications.destroy')->middleware('auth');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
