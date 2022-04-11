<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('user.login');
    }
}
