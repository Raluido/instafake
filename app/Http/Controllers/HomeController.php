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

        $images = User::where('id', $id)
            ->get('image');

        return view('user.home', compact('images', 'id'));
    }
}
