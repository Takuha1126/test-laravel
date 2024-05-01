<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
 　　* ユーザーのマイページを表示する
 　　*
　　 * @return \Illuminate\View\View
 　　*/
    public function mypage(){
    $user = Auth::user();
    $favorites = $user->favorites;
    $reservations = $user->reservations;

    return view('mypage', compact('reservations','favorites'));
}

}
