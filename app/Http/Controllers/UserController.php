<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follower;
use App\Models\Image;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function showProfile($nick)
    {
        $user = User::find(auth()->id());

        return view('user.myProfile', compact('user', 'nick'));
    }

    public function showData($nick)
    {
        $user = User::find(auth()->id());

        return view('user.showData', compact('nick', 'user'));
    }

    public function updateData($nick, UserUpdateRequest $request)
    {
        $user = User::find(auth()->id());
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->nick = $request->input('nick');
        $user->password = $request->input('password');
        if ($request->hasFile('avatar')) {
            if ($user->image != null && Storage::exists('profiles/' . $user->id . '/' . $user->image)) {
                unlink(public_path('profiles/' . $user->id . '/' . $user->image));
            }
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $fileName = 'avatar' . '_' . time() . '_.' . $extension;
            $file->storeAs('profiles/' . $user->id, $fileName);
            $user->image = $fileName;
        }
        $user->update($request->validated());

        return redirect()
            ->back()
            ->withSuccess('Hemos actualizado el usuario correctamente!');
    }

    public function deleteAvatar($nick)
    {
        $user = User::find(auth()->id());
        if (Storage::exists('profiles/' . $user->id . '/' . $user->image)) {
            unlink(public_path('profiles/' . $user->id . '/' . $user->image));
            $user->image = null;
            $user->update();
        }

        return redirect()
            ->back()
            ->withSuccess("La imagen se ha eliminado correctamente");
    }

    public function searchForm($nick)
    {
        $id = auth()->id();

        $images = Image::all();

        return view('user.searchForm', compact('nick', 'id', 'images'));
    }

    public function explore($nick, $imageId)
    {
        $images = Image::where('id', '>=', $imageId)
            ->get();

        return view('user.explore', ['nick' => $nick, 'images' => $images]);
    }

    public function publications($nick, $imageId = null)
    {
        $images = Image::where('user_id', auth()->id())
            ->get();

        return view('user.publications', ['nick' => $nick, 'images' => $images, 'imageId' => $imageId]);
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

        $followers = $user
            ->followings
            ->pluck('follower')
            ->toArray();

        return view('user.profile', compact('user', 'nick', 'followers'));
    }

    public function getImage($nick, $fileName, $id = null)
    {
        if ($id == null) {
            $id = auth()->user()->id;
        }

        return response()->file('profiles/' . $id . '/' . $fileName);
    }

    public function follow($nick, Request $request)
    {
        $result = Follower::create([
            'following' => $request->userId,
            'follower' => auth()->id()
        ]);

        if ($result) {
            $follower = Follower::where('following', $request->userId)
                ->count();
            return $follower;
        }

        $result = false;

        return $result;
    }

    public function remove($nick, Request $request)
    {
        $result = Follower::where('follower', auth()->id())
            ->where('following', $request->userId)
            ->delete();

        if ($result) {
            $follower = Follower::where('following', $request->userId)
                ->count();
            return $follower;
        }

        $result = false;

        return $result;
    }
}
