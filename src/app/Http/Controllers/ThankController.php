<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


class ThankController extends Controller
{

 public function index(){
        return view('thanks');
    }

}
