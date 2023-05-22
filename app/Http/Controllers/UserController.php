<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function showProfile($nick)
    {
        $user = User::find(auth()->id())
            ->get();

        $images = User::find(auth()->id())
            ->images()
            ->get();

        if (!isset($images[0])) {
            $images = "Vacío!";
        }

        $published = User::find(auth()->id())
            ->images()
            ->count();

        $followings = Follower::where('follower', auth()->id())
            ->count();

        $followers = Follower::where('following', auth()->id())
            ->count();


        return view('user.myProfile', compact('user', 'images', 'followers', 'followings', 'published', 'nick'));
    }
}
