<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\hash;

// authentication class to control login and registration
class AuthController extends Controller

{
    //login redirect
    public function login()
    {
        return view('index');
    }
    //register redirect
    public function register()
    {
        return view('register');
    }

    public function authenticate(Request $request)
    //login validation and authentication
    {
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/welcome');
        }

        return back()->withErrors([
            'email' => 'las credenciales no son correctas',
        ]);
    }

    public function store(Request $request){
        // registration validation and authentication
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'confirm-password' => 'required|same:password'
        ]);
        $data = $request->except('confirm-password', 'password');
        $data['password'] = Hash::make($request->password);
        user::create($data);
        return redirect('/login');
    }

    public function logout(Request $request)
    //"Log out" function
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
