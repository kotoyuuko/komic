<?php

use Chumper\Zipper\Zipper;

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

function extractZip($zipFile, $directory)
{
    $zipper = new Zipper();
    $zipper->make($zipFile)->extractTo($directory);
}
