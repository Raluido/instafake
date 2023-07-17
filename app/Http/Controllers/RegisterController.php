<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Models\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = new User();
        $user->nick = $validated['nick'];
        $user->email = $validated['email'];
        $filePath = $request->file('avatar');
        $fileName = 'avatar_' . date('Y-m-d_H.i.s') . '.' . $filePath->extension();
        $user->image = $fileName;
        $user->password = $validated['password'];
        $user->save();

        if (isset($user)) {
            Auth::login($user);
            $id = auth()->id();

            Session::push('user', [
                'user_id' => $id
            ]);

            $nick = auth()->user()->nick;

            return redirect()->route('home', compact('nick', 'id'));
        }

        return back()->with('error', 'Ha habido un error en el registro');
    }
}
