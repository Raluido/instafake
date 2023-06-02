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
        $id = auth()->id();

        return view('user.searchForm', compact('nick', 'id'));
    }

    public function search($nick, $inputSearch)
    {
        $users = User::where('nick', 'LIKE', '%' . $inputSearch . '%')
            ->where('nick', '!=', $nick)
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

    public function getImage($nick, $fileName)
    {
        $id = auth()->user()->id;

        return response()->file('images/' . $id . '/' . $fileName);
    }

    public function follow(Request $request)
    {
        $following = Follower::create([
            'following' => $request->following,
            'follower' => auth()->id()
        ]);

        return redirect()->back();
    }

    public function check($nick, $userId)
    {
        $following = Follower::where('following', $userId)
            ->where('follower', auth()->id())
            ->get();

        if (count($following) == 0) {
            $following = false;
        } else {
            $following = true;
        }

        return $following;
    }

    public function remove($nick, Request $request)
    {
        $delete = Follower::where('follower', auth()->id())
            ->where('following', $request['following'])
            ->delete();

        return redirect()->back();
    }
}
