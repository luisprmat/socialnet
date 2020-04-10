<?php

Route::view('/', 'welcome')->name('home');

// Statuses routes
Route::get('statuses', 'StatusController@index')->name('statuses.index');
Route::post('statuses', 'StatusController@store')->name('statuses.store')->middleware('auth');
// Route::resource('status', 'StatusController');

// Statuses likes routes
Route::post('statuses/{status}/likes', 'StatusLikesController@store')
    ->name('statuses.likes.store')->middleware('auth');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
