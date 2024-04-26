<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            return view('menu.after');
        } else {
            return view('menu.before');
        }
    }
}
