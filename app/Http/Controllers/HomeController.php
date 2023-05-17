<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
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
        $labels = "";

        $images = Db::table('followers')
            ->select('users.nick', 'users.id AS userId', 'images.id', 'images.name', 'images.location', 'images.filename', 'followers.following', 'followers.follower')
            ->join('users', 'users.id', '=', 'followers.following')
            ->join('images', 'images.user_id', '=', 'followers.following')
            ->where('followers.follower', '=', $id)
            ->get();

        if (empty($images[0])) {
            $images = "No hay imagenes aún!!";
            $comments = "";
            $likes = "";
            $labels = "";
        } else {
            $comments = Db::table('comments')
                ->select('users.nick', 'comments.image_id', 'comments.content')
                ->join('images', 'images.id', '=', 'comments.image_id')
                ->join('users', 'users.id', '=', 'comments.commentator')
                ->get();

            $likes = Like::select('image_id')
                ->where('giver', $id)
                ->get();

            $likesArr = array();

            if (!is_string($likes)) {
                foreach ($likes as $index) {
                    $likesArr[] = $index->image_id;
                }
            }

            $labels = Db::table('labels')
                ->select('users.nick')
                ->join('images', 'images.id', '=', 'labels.image_id')
                ->join('users', 'users.id', '=', 'labels.labeled')
                ->get();
        }

        return view('user.home', compact('images', 'likesArr', 'likes', 'comments', 'id', 'nick'));
    }
}
