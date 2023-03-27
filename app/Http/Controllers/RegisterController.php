<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Exists;
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
        $user = User::create($request->validated());

        if (isset($user)) {
            Auth::login($user);

            $id = auth()->id();
            Session::push('user', [
                'user_id' => $id
            ]);

            $nick = User::where('id', $id)
                ->value('nick');

            $path = public_path('storage') . '/storage/media/' . $id;

            if (!Storage::isDirectory($path)) {

                Storage::makeDirectory($path, 0777, true, true);
            }

            return redirect()->route('home', $nick);
        }

        return back()->with('error', 'Ha habido un error en el registro');
    }
}
