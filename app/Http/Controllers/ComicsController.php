<?php

namespace App\Http\Controllers;

class ComicsController extends Controller
{
    public function comics()
    {
        return view('comics.list');
    }

    public function viewer($name)
    {
        return $name;
    }
}
