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

function compressZip($zipFile, $files)
{
    $zipper = new Zipper();
    $zipper->make($zipFile);
    foreach ($files as $file) {
        $zipper->add(storage_path('app/' . $file));
    }
    $zipper->close();
}
