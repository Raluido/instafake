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
        if ($request->hasFile('avatar')) {
            $filePath = $request->file('avatar');
            $fileName = 'avatar_' . date('Y-m-d_H.i.s') . '.' . $filePath->getClientOriginalExtension();
            $user->image = $fileName;
        }
        $user->password = $validated['password'];
        $pass = $user->save();


        if ($pass) {
            if (Auth::attempt(['email' => $user->email, 'password' => $request->input('password')])) {
                $request->session()->regenerate();

                $user = auth()->user();
                $nick = $user->nick;

                Session::push('user', [
                    'user_id' => $user->id
                ]);

                $path = 'profiles/' . $user->id;
                if (!Storage::exists($path)) {
                    Storage::makeDirectory($path);
                } else {
                    Storage::deleteDirectory($path);
                    Storage::makeDirectory($path);
                }

                $filePath->storeAs($path, $fileName);

                return redirect()->route('home', ['nick' => $nick]);
            } else {
                return back()->with('error', 'Ha habido un error en el registro');
            }
        }
    }
}
