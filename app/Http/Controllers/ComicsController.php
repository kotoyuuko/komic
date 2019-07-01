<?php

namespace App\Http\Controllers;

use App\Comic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComicsController extends Controller
{
    public function viewer($name)
    {
        return $name;
    }

    public function showUploadForm()
    {
        return view('comics.upload');
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');

        if (!$file->isValid()) {
            return redirect()->back();
        }

        if ($file->extension() !== 'zip') {
            return redirect()->back();
        }

        $origName = explode('.', $file->getClientOriginalName())[0];
        $storeName = Str::random(16);
        $path = $file->storeAs('comics', $storeName . '.zip');

        $comic = new Comic;
        $comic->user_id = $request->user()->id;
        $comic->name = $storeName;
        $comic->title = $origName;
        $comic->cover = 'null';
        $comic->save();

        return redirect()->route('root');
    }
}
