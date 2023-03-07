<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HelperController extends Controller
{
    public function getHomeUrl()
    {
        if (Auth::check()) {
            $id = auth()->id();
            $nick = User::where('id', $id)
                ->value('nick');

            return '/' . $nick;
        }

        return '/';
    }
}
