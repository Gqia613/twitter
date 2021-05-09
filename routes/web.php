<?php

Route::get('/', 'MypageController@index');
Route::post('/', 'MypageController@add');

Route::get('/tweeted', 'MypageController@tweeted');

Route::get('/tweet', 'AutoController@tweet');

Route::post('/delete', 'MypageController@delete');

Route::get('/search', 'MypageController@search');
Route::post('/search', 'MypageController@searchRes');

Route::get('/favorite', 'MypageController@favorite');
Route::post('/favorite', 'MypageController@favoriteRes');

Route::get('/autofallow', 'MypageController@auto');
Route::post('/autofallow', 'MypageController@autoRes');

Route::get('/callback', 'MypageController@callback');

Route::get('/autotweet', 'AutoController@autotweet');

Route::get('/fixedtweet', 'MypageController@fixedtweet');
Route::post('/fixedtweet', 'MypageController@fixedtweetRes');




Auth::routes();
// Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
