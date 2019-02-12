<?php

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'ProductController@index');
Route::post('products/multipleDelete', 'ProductController@multipleDelete')->name('multipleDelete')->middleware('auth');
Route::resource('products', 'ProductController');

Route::get('/products/{product}/updateReviews', 'ReviewController@updateReviews')->name('updateReviews');
Route::delete('review/destroy/{review}', 'ReviewController@destroy');
Route::post('/products/{product}/postReview', 'ReviewController@store')->name('postReview');
Route::resource('reviews', 'ReviewController');
