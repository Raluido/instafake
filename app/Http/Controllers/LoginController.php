<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{

    public function show()
    {
        return view('auth.login');
    }


    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $id = auth()->id();
            Session::push('user', [
                'user_id' => $id
            ]);

            $nick = User::where('id', $id)
                ->value('nick');

            $path = public_path('storage') . '/media/' . $id;

            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            return redirect()->route('home', compact('nick', 'id'));
        }

        return back()->withErrors([
            'email' => 'Tu email no coincide con el de la base de datos.',
        ])->onlyInput('email');
    }
}
