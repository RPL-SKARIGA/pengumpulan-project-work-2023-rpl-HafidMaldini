<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Index()
{
    // $user = Auth::user();
    return view('auth.login');
}

public function login(Request $request)
{

    $credentials = $request->only('email', 'password');

    $field = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

    if($field == 'name') {
        $credentials[$field] = $credentials['email'];
        unset($credentials['email']);
    }

    if (Auth::attempt($credentials,true)) {
        $user = Auth::user();
        
        if($user->role == "admin") {
            return redirect( route('adminDashboard') );
        }else{
            return redirect( route('index'));
        }
        return redirect('/');
    } else {
        return back()->withErrors('Email Atau Password Anda Salah');
    }

}


public function showRegistrationForm()
{
    return view('auth.register');
}

public function register(Request $request)
{
    $this->validate($request, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:user',
        'password' => 'required|string|min:8|confirmed',
    ]);

    user::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'likes' => $request->like,
    ]);

    return redirect()->route('login')->with('success', 'Registration successful. Please login.');
}

public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
}

}
