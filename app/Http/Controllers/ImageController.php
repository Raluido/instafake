<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ImageController extends Controller
{
    public function uploadForm($nick)
    {
        return view('images.uploadForm')->with('nick', $nick);
    }

    public function store(Request $request, $nick)
    {
        $img = $request->all();

        return redirect()->route('images.publishForm', ['nick' => $nick]);
    }

    public function publishForm($nick)
    {
        log::info($nick);

        return view('images.publishForm', ['nick' => $nick]);
    }

    public function publish(Request $request)
    {
        $id = auth()->id();

        $img = ($img['imgBase64']);
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);
        //saving
        $fileName = public_path('storage/media/' . $id . '/' . 'photo.png');
        file_put_contents($fileName, $fileData);
    }
}
