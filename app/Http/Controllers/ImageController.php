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
        $img = $request->file('picture');
        $img = file_get_contents($img);
        $pathName = public_path('images/tmp/' . auth()->id() . '_' . time() . '.jpeg');
        file_put_contents($pathName, $img);
        $fileName = pathinfo($pathName)['basename'];
        DeleteTmpImg::dispatch($fileName)->delay(now()->addMinutes(5));

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
                Storage::makeDirectory($path);
            }

            rename(public_path('images/tmp/' . $fileName), public_path('images/' . $id . '/' . $fileName));

            return redirect()->route('home', ['nick' => $nick]);
        } else {
            echo "Tiempo excedido!!";
            sleep(5);
            return redirect()->back();
        }
    }

    public function editForm($nick, $imageId)
    {
        $image = Image::where('id', $imageId)
            ->get();
        $image = $image[0];

        return view('images.edit', ['nick' => $nick, 'image' => $image]);
    }

    public function edit($nick, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'location' => 'required'
        ]);

        $image = Image::find($request->imageId);
        $image->name = $request->input('name');
        $image->location = $request->input('location');
        $image->update();

        return redirect()
            ->route('user.publications', $nick);
    }

    public function delete($nick, $imageId)
    {
        $likesComments = Db::Table('likes_comments')
            ->join('comments', 'comments.id', '=', 'likes_comments.comment_id')
            ->where('comments.image_id', '=', $imageId)
            ->delete();

        if ($likesComments >= 0) {
            $comments = Db::Table('comments')
                ->where('image_id', $imageId)
                ->delete();
            if ($comments >= 0) {
                $likes = Db::Table('likes')
                    ->where('image_id', $imageId)
                    ->delete();
                if ($likes >= 0) {
                    $fileName = Image::find($imageId);
                    if (Storage::fileExists('images/' . auth()->id() . '/' . $fileName->name)) {
                        Storage::delete('images/' . auth()->id() . '/' . $fileName->name);
                    }
                    $delete = Db::Table('images')
                        ->where('id', $imageId)
                        ->delete();
                    if ($delete >= 0) {
                        return redirect()
                            ->route('user.publications', $nick)
                            ->withSuccess("La imagen se ha eliminado correctamente");
                    }
                }
            }
        }
        return redirect()
            ->back()
            ->withErrors("Ha habido un error al intentar eliminar la imagen.");
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
