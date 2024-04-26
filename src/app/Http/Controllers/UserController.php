<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function mypage(){
    $user = Auth::user();
    $favorites = $user->favorites;
    $reservations = $user->reservations;

    return view('mypage', compact('reservations','favorites'));
}

}
