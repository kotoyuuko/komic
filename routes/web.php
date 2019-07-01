<?php

Route::get('/', 'PagesController@root')->name('root');
Route::get('/comic', 'ComicsController@comics')->name('comic.list');
Route::get('/comic/{name}', 'ComicsController@viewer')->name('comic.viewer');
Route::get('/upload', 'PagesController@upload')->name('upload');
