<?php

Route::view('/', 'welcome')->name('home');

Route::get('statuses', 'StatusController@index')->name('statuses.index');
Route::post('statuses', 'StatusController@store')->name('statuses.store')->middleware('auth');
// Route::resource('status', 'StatusController');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
