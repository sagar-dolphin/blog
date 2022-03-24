<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Session;
use Hash;

class LoginController extends Controller
{   
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where(["email" => $credentials['email']])->first();
            $remember_me  = ( !empty( $request->remember_me ) )? TRUE : FALSE;
            Auth::login($user, $remember_me);
            // Authentication passed...
            return redirect()->intended('admin');
        }else {
            return redirect()->back()->with(Session::flash('msg' , 'Oops, Your credentials does not match with our records!'));
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
