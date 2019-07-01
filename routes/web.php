<?php

Auth::routes();

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/', 'PagesController@root')->name('root');
    Route::get('/comic/{name}', 'ComicsController@viewer')->name('comic.viewer');
    Route::get('/upload', 'PagesController@upload')->name('upload');
});
