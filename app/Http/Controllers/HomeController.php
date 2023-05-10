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
            ->select('users.nick', 'images.id', 'images.name', 'images.location', 'images.filename', 'followers.following', 'followers.follower')
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

            if (empty($comments[0])) {
                $comments = "";
            }

            $likes = Db::table('likes')
                ->select('users.nick', 'likes.image_id', 'likes.giver')
                ->join('images', 'images.id', '=', 'likes.image_id')
                ->join('users', 'users.id', '=', 'likes.giver')
                ->get();

            if (empty($likes[0])) {
                $likes = "";
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

        return view('user.home', compact('images', 'likes', 'comments', 'id', 'nick'));
    }
}
