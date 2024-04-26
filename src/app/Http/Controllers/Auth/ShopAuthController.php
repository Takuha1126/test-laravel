<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Shop;
use App\Models\ShopRepresentative;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShopLoginRequest;

class ShopAuthController extends Controller
{
    private function attemptLogin($credentials, $redirectRoute)
    {
        if (Auth::guard('shop')->attempt($credentials)) {
            return redirect()->route($redirectRoute);
        }

        return back();
    }

    public function showLoginForm()
    {   
        $shops = Shop::all();
        return view('shops.login',compact('shops'));
    }

    public function login(ShopLoginRequest $request)
{

    $request->validate([
        'shop_id' => 'required',
        'password' => 'required',
    ]);

    $representative = ShopRepresentative::where('shop_id', $request->shop_id)->first();

    if ($representative && Hash::check($request->password, $representative->password)) {
        Auth::guard('shop')->login($representative);

        return redirect()->route('shops.reservations.list', ['shop_id' => $request->shop_id]);
    }

    return back()->with('error_message','店舗IDまたはパスワードが正しくありません');
}




    public function logout()
    {
        Auth::guard('shop')->logout();
        return redirect('/shop/login');
    }

    
}
