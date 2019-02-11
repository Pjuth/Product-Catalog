<?php

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'ProductController@index')->name('products.index');
Route::post('/products/{product}/postReview', 'ReviewController@store')->name('postReview')->middleware('auth');
Route::delete('review/destroy/{review}', 'ReviewController@destroy')->middleware('auth');
Route::resource('products', 'ProductController')->middleware('auth');
Route::get('/products/{product}/updateReviews', 'ReviewController@updateReviews')->name('updateReviews')->middleware('auth');
Route::resource('reviews', 'ReviewController')->middleware('auth');
