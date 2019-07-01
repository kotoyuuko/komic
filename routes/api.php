<?php

Route::middleware('auth:api')
    ->get('/comic/{name}.json', 'ComicsController@detailJson')
    ->name('api.comic.detail');
