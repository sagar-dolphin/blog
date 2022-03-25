<?php 
  
namespace App\Http\Controllers\Auth; 
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Mail\ResetPassword;
use App\Http\Requests\SubmitForgetPasswordRequest;
use App\Http\Requests\SubmitResetPasswordRequest;
use DB; 
use URL;
use Carbon\Carbon; 
use App\Models\User; 
use Mail; 
use Hash;
use Illuminate\Support\Str;
  
class ForgotPasswordController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
         return view('admin.auth.forgetPassword');
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(SubmitForgetPasswordRequest $request)
      {

        try {
            $token = Str::random(64);
            DB::table('password_resets')->insert([
                'email' => $request->email, 
                'token' => $token, 
                'created_at' => Carbon::now()
              ]); 
              $mailData = [
                  'url' => URL::to('/').'/admin/reset-password/'.$token,
              ];
              Mail::to($request->email)->send(new ResetPassword($mailData));
              return back()->with('message', 'We have e-mailed your password reset link!');
        } catch (\Exception $e) {
            return back()->with('message', 'Something went wrong!');
        }
         
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) { 
         return view('admin.auth.forgetPasswordLink', ['token' => $token]);
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(SubmitResetPasswordRequest $request)
      {
          try {
            $updatePassword = DB::table('password_resets')->where([
              'email' => $request->email, 
              'token' => $request->token
            ])->first();
            if(!$updatePassword){
                return back()->withInput()->with('token', 'Invalid token!');
            }
            $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
            DB::table('password_resets')->where(['email'=> $request->email])->delete();
            $request->session()->flash('password_message', 'Your password has been changed!');
            return redirect()->route('admin.login');
          } catch (\Exception $e) {
            $request->session()->flash('password_message', 'Something went wrong!');
            return redirect()->route('admin.login');
          }
      }
}