<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function Index(){
        return view('Admin.login');
    }

    public function login(Request $request)
{
    $admin = admin::all();
    dd($admin->username);
    $credentials = $request->only($admin->username, $admin->password);


    if (Auth::attempt($credentials,true)) {
        return redirect('/Admin');
    } else {
        return back()->withErrors(['username' => $request->username , 'pass' => $request->password]);
    }
}

public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
}
}
