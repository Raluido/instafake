<?php

namespace App\Http\Controllers;

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
            $likedAr = "";
            $labels = "";
        } else {
            $comments = Db::table('comments')
                ->select('users.nick', 'comments.image_id', 'comments.content')
                ->join('images', 'images.id', '=', 'comments.image_id')
                ->join('users', 'users.id', '=', 'comments.commentator')
                ->get();

            if (empty($comments[0])) {
                $comments = "";
            }

            //images with likes (from everyone) from following's user logued

            // $likes = Db::select("SELECT DISTINCT likes.image_id FROM likes WHERE likes.image_id IN
            //  (SELECT DISTINCT images.id FROM followers JOIN images ON images.user_id = followers.following 
            //  WHERE followers.follower = $id);");

            $likes = Db::table('likes')
                ->select('image_id')
                ->get();

            if (empty($likes[0])) {
                $likes = "";
            }

            $liked = Db::select("SELECT DISTINCT likes.image_id, likes.giver FROM likes WHERE likes.image_id IN
            (SELECT DISTINCT images.id FROM followers JOIN images ON images.user_id = followers.following 
            WHERE followers.follower = $id);");

            if (empty($liked[0])) {
                $liked = "";
            }

            $likedAr = [];

            foreach ($liked as $index) {
                if ($index->giver == $id) {
                    $likedAr[] = $index->image_id;
                }
            }

            if (empty($likedAr[0])) {
                $likedAr = "";
            }

            $labels = Db::table('labels')
                ->select('users.nick')
                ->join('images', 'images.id', '=', 'labels.image_id')
                ->join('users', 'users.id', '=', 'labels.labeled')
                ->get();

            if (empty($labels[0])) {
                $labels = "";
            }
        }

        return view('user.home', compact('images', 'likes', 'likedAr', 'comments', 'id', 'nick'));
    }
}
