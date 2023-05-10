<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteTmpImg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Exists;
use App\Models\Image;
use App\Models\User;
use App\Models\Like;
use Illuminate\Support\Facades\DB;

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
        $pathName = public_path('storage/tmp/' . $id . '_' . time() . '.png');
        file_put_contents($pathName, $fileData);
        $fileName = pathinfo($pathName)['basename'];
        DeleteTmpImg::dispatch($fileName)->delay(now()->addMinutes(5));

        return $fileName;
    }

    public function publishForm($nick, $fileName)
    {
        return view('images.publishForm', ['nick' => $nick, 'fileName' => $fileName]);
    }

    public function published(Request $request, $nick)
    {
        $id = auth()->id();

        $fileName = $request->input('fileName');

        $path = public_path('storage/tmp/' . $fileName);
        if (file_exists($path)) {
            $image = new Image();
            $image->user_id = $id;
            $image->fileName = $request->input('fileName');
            $image->name = $request->input('name');
            $image->location = $request->input('location');
            // $image->labels = $request->input('labels');
            $image->save();

            rename(public_path('storage/tmp/' . $fileName), public_path('storage/media/' . $id . '/library/images/' . $fileName));

            return redirect()->route('home', ['nick' => $nick]);
        } else {
            echo "Tiempo excedido!!";
            sleep(5);
            return redirect()->back();
        }
    }

    public function liked(Request $request, $nick)
    {
        $liked = $request->all();
        $check = Db::table('likes')
            ->where('giver', $liked['userId'])
            ->where('image_id', $liked['imageId'])
            ->exists();

        if ($check != 1) {
            $like = new Like();
            $like->image_id = $liked['imageId'];
            $like->giver = $liked['userId'];
            $like->save();
            return true;
        } else {
            $check = Db::table('likes')
                ->where('giver', $liked['userId'])
                ->where('image_id', $liked['imageId'])
                ->delete();
            return false;
        }
    }

    // public function checkLikes(Request $request, $nick)
    // {
    //     log::info("este es");
    //     $liked = $request->all();
    //     $check = Db::table('likes')
    //         ->where('giver', $liked['userId'])
    //         ->where('image_id', $liked['imageId'])
    //         ->exists();

    //     if ($check != 1) {
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }
}
