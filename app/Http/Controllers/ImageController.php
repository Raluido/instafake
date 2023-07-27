<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteTmpImg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
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
        // $img = ($img['imgBase64']);
        // $img = str_replace('data:image/png;base64,', '', $img);
        // $img = str_replace(' ', '+', $img);
        // $fileData = base64_decode($img);

        $id = auth()->id();
        if ($request->hasFile('image_url')) {
            $img = $request->file('image_url');
            //saving

            $pathName = public_path('images/tmp/' . $id . '_' . time() . '.png');
            file_put_contents($pathName, $img);
            $fileName = pathinfo($pathName)['basename'];
            DeleteTmpImg::dispatch($fileName)->delay(now()->addMinutes(5));
        }

        return $fileName;
    }

    public function publishForm($nick, $fileName)
    {
        return view('images.showPublishForm', ['nick' => $nick, 'fileName' => $fileName]);
    }

    public function published(Request $request, $nick)
    {
        $id = auth()->id();

        $fileName = $request->input('fileName');

        $path = 'images/tmp/' . $fileName;

        if (Storage::exists($path)) {
            $image = new Image();
            $image->user_id = $id;
            $image->fileName = $request->input('fileName');
            $image->name = $request->input('name');
            $image->location = $request->input('location');
            // $image->labels = $request->input('labels');
            $image->save();

            $path = 'images/' . $id;

            if (Storage::exists($path)) {
            } else {
                Storage::makeDirectory($path, 0777, true, true);
            }

            rename(public_path('images/tmp/' . $fileName), public_path('images/' . $id . '/' . $fileName));

            return redirect()->route('home', ['nick' => $nick]);
        } else {
            echo "Tiempo excedido!!";
            sleep(5);
            return redirect()->back();
        }
    }

    public function delete($nick, Image $image)
    {
        $delete = Db::Table('image')
            ->where('id', $image->id)
            ->delete();

        if ($delete) {
            return redirect()
                ->back()
                ->withSuccess("La imagen se ha eliminado correctamente");
        }
    }

    public function liked($nick, $dataId)
    {
        $id = auth()->id();

        $check = Db::select("SELECT * FROM likes WHERE likes.giver = $id AND likes.image_id = $dataId;");

        if (empty($check[0])) {
            $like = new Like();
            $like->image_id = $dataId;
            $like->giver = $id;
            $like->save();

            $likesAmount = Db::table('likes')
                ->where('image_id', $dataId)
                ->count();

            $result = [
                true,
                $likesAmount,
            ];

            return $result;
        } else {
            $check = Db::table('likes')
                ->where('giver', $id)
                ->where('image_id', $dataId)
                ->delete();

            $likesAmount = Db::table('likes')
                ->where('image_id', $dataId)
                ->count();

            $result = [
                false,
                $likesAmount,
            ];

            return $result;
        }
    }

    public function getImage($nick, $fileName)
    {
        $id = auth()->user()->id;

        return response()->file('profiles/' . $id . '/' . $fileName);
    }
}
