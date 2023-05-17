<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StoryController extends Controller
{
    public function getAll($nick, $storyId, $userId)
    {
        $id = auth()->id();

        $stories = Db::table('followers')
            ->select('stories.user_id', 'stories.id')
            ->join('stories', 'stories.user_id', '=', 'followers.following')
            ->join('users', 'users.id', '=', 'followers.following')
            ->where('followers.follower', '=', $id)
            ->where('stories.id', '<=', $storyId)
            ->get();

        if ($stories[0] == "") {
            $stories = "";
        }

        log::info($stories);

        return $stories;
    }
}