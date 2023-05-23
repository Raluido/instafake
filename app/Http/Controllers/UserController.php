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
        $user = User::find(auth()->id());

        return view('user.myProfile', compact('user', 'nick'));
    }
}
