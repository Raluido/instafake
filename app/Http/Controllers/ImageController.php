<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\TemporaryDirectory\TemporaryDirectory;

class ImageController extends Controller
{
    public function uploadForm($nick)
    {
        return view('images.uploadForm')->with('nick', $nick);
    }

    public function store(Request $request, $nick)
    {
        $id = auth()->id();

        $img = $request->all();
        $img = ($img['imgBase64']);
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);
        //saving
        $location = public_path('storage/temp');
        $name = time();
        $newLocation = (new TemporaryDirectory($location))
            ->name($name)
            ->create();
        $pathName = public_path('storage/temp/' . $name . '/' . $id . '_' . time() . '.png');
        file_put_contents($pathName, $fileData);
        $fileName = pathinfo($pathName)['basename'];

        return $fileName;
    }

    public function publishForm($nick, $fileName)
    {
        return view('images.publishForm', ['nick' => $nick])->with('fileName', $fileName);
    }

    public function publish(Request $request)
    {
        $id = auth()->id();
    }
}
