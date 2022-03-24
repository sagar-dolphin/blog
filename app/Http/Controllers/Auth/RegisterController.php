<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use URL;
use App\Models\UserVerify;
use App\Mail\VerifyUser;
use Illuminate\Support\Str;
use Mail;
use Session;
use Hash;

class RegisterController extends Controller
{

    public function showRegisterForm()
    {
        return view('admin.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        // $validated = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|confirmed|min:6',
        // ]);
           $user = User::create($request->all());
           $token = Str::random(64);
           $mailData = [
            'title' => 'Mail from dolphinwebsolutions.com',
            'url' => URL::to('/').'/admin/email/verify/'.$token
            ];
           UserVerify::create([
            'user_id' => $user->id, 
            'token' => $token
            ]);
            try {
                Mail::to($request->email)->send(new VerifyUser($mailData));
                return redirect()->back()->with($request->session()->flash('status', 'Mail sent successfully! Please verify your email address!'));
            } catch (\Exception $e) {
                return redirect()->back()->with($request->session()->flash('status', 'Failed to send mail!'));
            }
    }

    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();
        $message = 'Sorry your email cannot be identified.';
        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->is_email_verified) {
                $verifyUser->user->email_verified_at = now();
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
                return redirect()->route('admin.login')->with(Session::flash('verify-message', 'Your e-mail is verified. You can now login.'));
            } else {
                $message = "Your e-mail is already verified. You can now login.";
                return redirect()->route('admin.login')->with(Session::flash('verify-message', 'Your e-mail is already verified. You can now login..'));
            }
        }
        return redirect()->route('admin.register')->with('message', $message);
    }
}
