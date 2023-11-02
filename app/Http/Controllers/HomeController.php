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

        $followings = Follower::where('follower', $id)
            ->get();

        $followingId = Follower::where('follower', $id)
            ->value('following');

        $stories = Db::table('followers')
            ->select('stories.user_id', 'stories.id', 'users.nick', 'users.image')
            ->join('stories', 'stories.user_id', '=', 'followers.following')
            ->join('users', 'users.id', '=', 'followers.following')
            ->where('followers.follower', '=', $id)
            ->orderBy('stories.id', 'DESC')
            ->get();

        return view('home.index', compact('followings', 'followingId', 'stories', 'nick'));
    }
}
