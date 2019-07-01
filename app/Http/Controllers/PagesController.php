<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function root()
    {
        return view('pages.root');
    }

    public function upload()
    {
        return view('pages.upload');
    }
}
