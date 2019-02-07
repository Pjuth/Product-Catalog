<?php

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'ProductController@index')->name('products.index');
Route::resource('products', 'ProductController')->middleware('auth');
