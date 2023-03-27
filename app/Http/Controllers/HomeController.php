<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index($nick)
    {
        $id = auth()->id();

        $images = User::find($id)->images;

        if (empty($images)) {
            $images = "No hay imagenes aún!!";
        }

        return view('user.home', compact('images', 'id', 'nick'));
    }

    public function showMessages($nick)
    {
        $id = auth()->id();

        $messages = Db::table('messages')->where('sender_id', $id)->get();

        return view('user.messages', compact('nick', 'id', 'messages'));
    }
}
