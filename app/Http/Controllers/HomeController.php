<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;


class HomeController extends Controller
{
    public function index()
    {
        $id = auth()->id();

        $images = User::find($id)->images;

        if (empty($images)) {
            $images = "No hay imagenes aún!!";
        }

        return view('user.home', compact('images', 'id'));
    }

    public function showMessages()
    {
        return view('user.messages');
    }
}
