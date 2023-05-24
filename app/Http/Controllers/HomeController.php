<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Like;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\LikeComment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class HomeController extends Controller
{
    public function index($nick)
    {
        $id = auth()->id();
        $stories = "";
        $likesComments = "";

        $followings = Follower::where('follower', $id)
            ->get();

        $stories = Db::table('followers')
            ->select('stories.user_id', 'stories.id', 'users.nick')
            ->join('stories', 'stories.user_id', '=', 'followers.following')
            ->join('users', 'users.id', '=', 'followers.following')
            ->where('followers.follower', '=', $id)
            ->orderBy('stories.id', 'DESC')
            ->get();


        $likesComments = LikeComment::select('comment_id')
            ->where('giver', '=', $id)
            ->get();

        if (!is_string($likesComments)) {
            $likesCommentsArr = array();
            foreach ($likesComments as $index) {
                $likesCommentsArr[] = $index['comment_id'];
            }
        }

        return view('home.index', compact('followings', 'id', 'nick'));
    }
}
