<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class StoryController extends Controller
{
    public function playAll($nick, $storyId, $userId)
    {
        $id = auth()->id();

        $stories = Db::table('followers')
            ->select('stories.user_id', 'stories.id', 'stories.path')
            ->join('stories', 'stories.user_id', '=', 'followers.following')
            ->join('users', 'users.id', '=', 'followers.following')
            ->where('followers.follower', '=', $id)
            ->where('stories.id', '<=', $storyId)
            ->get();

        if ($stories[0] == "") {
            $stories = "";
        }

        return $stories;
    }

    public function getAll()
    {
        $id = auth()->id();

        $stories = Db::table('followers')
            ->select('stories.user_id', 'stories.id', 'users.nick')
            ->join('stories', 'stories.user_id', '=', 'followers.following')
            ->join('users', 'users.id', '=', 'followers.following')
            ->where('followers.follower', '=', $id)
            ->orderBy('stories.id', 'DESC')
            ->get();

        return $stories;
    }

    public function getStory($nick, $fileName)
    {
        $id = auth()->user()->id;

        return response()->file('stories/' . $id . '/' . $fileName);
    }

    public function uploadForm($nick)
    {
        return view('stories.uploadForm')->with('nick', $nick);
    }

    public function store($nick, Request $request)
    {
        if ($request->hasFile('videoFile')) {
            $story = new Story();
            $story->user_id = auth()->id();
            $path = public_path('stories') . '/' . auth()->id();
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
            }
            $fileName = date('Y-m-d_H.i.s') . '.' . $request->file('videoFile')->extension();
            $filepath = $request->file('videoFile');
            $filepath->storeAs('/' . auth()->id(), $fileName, 'stories');
            $story->path = $fileName;
            $story->save();

            return redirect()
                ->back()
                ->withSuccess("La story se ha añadido correctamente");
        } else {
            return redirect()
                ->back()
                ->withErrors("No has seleccionado ninguna story");
        }
    }
}
