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
        $images = "";
        $comments = "";
        $likes = "";
        $likesArr = "";
        $labels = "";
        $stories = "";
        $likesComments = "";

        $followings = Follower::where('follower', $id)
            ->get();

        // foreach ($follower as $index) {
        //     foreach ($index->userFollowing->images as $index1) {
        //         log::info($index->following . $index->userFollowing->nick . $index1);
        //     }
        // }

        // $images = Db::table('followers')
        //     ->select('users.nick', 'users.id AS userId', 'images.id', 'images.name', 'images.location', 'images.filename', 'followers.following', 'followers.follower')
        //     ->join('users', 'users.id', '=', 'followers.following')
        //     ->join('images', 'images.user_id', '=', 'followers.following')
        //     ->where('followers.follower', '=', $id)
        //     ->get();

        // if (empty($images[0])) {
        //     $images = "No hay imagenes aún!!";
        //     $comments = "";
        //     $likes = "";
        //     $labels = "";
        // } else {
        //     $comments = Db::table('comments')
        //         ->select('users.nick', 'comments.id', 'comments.image_id', 'comments.content')
        //         ->join('images', 'images.id', '=', 'comments.image_id')
        //         ->join('users', 'users.id', '=', 'comments.commentator')
        //         ->get();

        //     $likes = Like::select('image_id')
        //         ->where('giver', $id)
        //         ->get();

        //     if (!is_string($likes)) {
        //         $likesArr = array();
        //         foreach ($likes as $index) {
        //             $likesArr[] = $index->image_id;
        //         }
        //     }

        //     $labels = Db::table('labels')
        //         ->select('users.nick')
        //         ->join('images', 'images.id', '=', 'labels.image_id')
        //         ->join('users', 'users.id', '=', 'labels.labeled')
        //         ->get();
        // }

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
