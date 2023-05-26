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

    public function searchForm($nick)
    {
        return view('user.searchForm')->with(['nick' => $nick]);
    }

    public function search($nick, $inputSearch)
    {
        $users = User::where('nick', 'LIKE', '%' . $inputSearch . '%')
            ->get();

        return $users;
    }

    public function showProfiles($nick, $userId)
    {
        $user = User::where('id', $userId)
            ->get();

        $user = $user[0];

        return view('user.profile', compact('user', 'nick'));
    }
}
