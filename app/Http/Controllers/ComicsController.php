<?php

namespace App\Http\Controllers;

use App\Comic;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use Storage;

class ComicsController extends Controller
{
    public function viewer(Request $request, $name)
    {
        $token = Auth::guard('api')->fromUser($request->user());

        $comic = Comic::where('name', $name)->first();

        if (!$comic) {
            return redirect()->route('root');
        }

        return view('comics.viewer', compact('comic', 'token'));
    }

    public function image(Request $request, $name, $page)
    {
        $comic = Comic::where('name', $name)->first();

        if (!$comic) {
            abort(404);
            return;
        }

        if ($comic->user_id !== $request->user()->id) {
            abort(403);
            return;
        }

        $tmpPath = 'tmp/' . $comic->name;

        if (!Storage::exists($tmpPath)) {
            $zipFullPath = storage_path('app/comics/' . $comic->name . '.zip');
            $dirFullPath = storage_path('app/tmp/' . $comic->name);
            extractZip($zipFullPath, $dirFullPath);
        }

        $files = Storage::files($tmpPath);
        natsort($files);

        $sortedFiles = [];
        foreach ($files as $file) {
            $sortedFiles[] = $file;
        }

        if ($page <= 0 || $page > count($sortedFiles)) {
            abort(404);
            return;
        }

        $imageFullPath = storage_path('app/' . $sortedFiles[$page - 1]);

        return response()->file($imageFullPath);
    }

    public function detailJson(Request $request, $name)
    {
        $comic = Comic::where('name', $name)->first();

        if (!$comic) {
            abort(404);
            return;
        }

        if ($comic->user_id !== $request->user()->id) {
            abort(403);
            return;
        }

        $tmpPath = 'tmp/' . $comic->name;

        if (!Storage::exists($tmpPath)) {
            $zipFullPath = storage_path('app/comics/' . $comic->name . '.zip');
            $dirFullPath = storage_path('app/tmp/' . $comic->name);
            extractZip($zipFullPath, $dirFullPath);
        }

        $files = Storage::files($tmpPath);

        $data = [];
        for ($i = 1; $i <= count($files); $i++) {
            $data[] = route('comic.image', [$name, strval($i)]);
        }

        return response()->json($data);
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
        natsort($files);

        $coverFullPath = storage_path('app/' . array_shift($files));
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

    public function delete(Request $request, $name)
    {
        $comic = Comic::where('name', $name)->first();

        if (!$comic) {
            abort(404);
            return;
        }

        if ($comic->user_id !== $request->user()->id) {
            abort(403);
            return;
        }

        Storage::delete('comics/' . $comic->name . '.zip');

        $comic->delete();

        return redirect()->route('root');
    }
}
