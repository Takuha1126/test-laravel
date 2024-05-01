<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Hash;


class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }


    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
        return redirect()->route('admin.index');
        } else {
        return back()->withInput()->withErrors(['loginError' => 'メールアドレスまたはパスワードが間違っています。']);
        }
    }



    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

    public function showRegistrationForm()
    {
        return view('admin.register');
    }

    public function register(AdminRequest $request)
    {

    $admin = Admin::create([
        'admin_name' => $request->admin_name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);

    Auth::guard('admin')->login($admin);

    return redirect()->route('admin.index');
    }

}
