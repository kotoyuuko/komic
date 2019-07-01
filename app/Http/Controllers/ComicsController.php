<?php

namespace App\Http\Controllers;

use App\Comic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use Storage;

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

        $zipFullPath = storage_path('app/comics/' . $storeName . '.zip');
        $dirFullPath = storage_path('app/tmp/' . $storeName);
        extractZip($zipFullPath, $dirFullPath);

        $files = Storage::files('tmp/' . $storeName);
        $coverFullPath = storage_path('app/' . $files[0]);
        $coverImage = Image::make($coverFullPath)->resize(140, 200);
        $coverDataUrl = $coverImage->encode('data-url');

        $comic = new Comic;
        $comic->user_id = $request->user()->id;
        $comic->name = $storeName;
        $comic->title = $origName;
        $comic->cover = $coverDataUrl;
        $comic->save();

        return redirect()->route('root');
    }
}
