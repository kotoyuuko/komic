<?php

Route::get('/login', 'Auth\\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\\LoginController@login');
Route::get('/register', 'Auth\\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\\RegisterController@register');
Route::post('/logout', 'Auth\\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'PagesController@root')->name('root');
    Route::get('/comic/{name}', 'ComicsController@viewer')->name('comic.viewer');
    Route::get('/comic/{name}/delete', 'ComicsController@delete')->name('comic.delete');
    Route::get('/comic/{name}/{page}', 'ComicsController@image')->name('comic.image');
    Route::get('/upload', 'ComicsController@showUploadForm')->name('upload');
    Route::post('/upload', 'ComicsController@upload');
});
