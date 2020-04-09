<?php

Route::view('/', 'welcome');

Route::post('status', 'StatusController@store')->name('status.store')->middleware('auth');
// Route::resource('status', 'StatusController');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
