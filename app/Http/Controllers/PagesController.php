<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function root(Request $request)
    {
        $comics = $request->user()->comics()->simplePaginate(15);

        return view('pages.root', compact('comics'));
    }
}
