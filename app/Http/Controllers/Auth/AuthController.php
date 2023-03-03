<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ResetPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $req)
    {
        // echo "<pre>";
        // print_r($req->all());
        // echo "</pre>";
        $credentials = $req->only('email', 'password');
        $user = User::where('email', $req->email)->first();
        if (!empty($user)) {
            if ($req->type == 'admin' && $user->is_admin == 1) {
                $admin = Auth::attempt($credentials);
                if(!empty($admin)){
                    return redirect()->intended(route('admin.home'));
                }
                return redirect()->route('login')->with('failed', 'Your Password is wrong.');

            } else if ($req->type == 'employee' && $user->is_admin == 0) {
                if ($user->status == 1) {
                    $emp = Auth::attempt($credentials);
                    if(!empty($emp)){
                        return redirect()->intended(route('employee.home'));
                    }
                    return redirect()->route('login')->with('failed', 'Your Password is wrong.');
                } else {
                    return redirect()->route('login')->with('failed', 'Are you blocked. Please contact Administrator.');
                }
            } else {
                return redirect()->route('login')->with('failed', 'Unauthorize Access. Please contact Administrator.');
            }
        } else {
            return redirect()->route('login')->with('failed', 'Your Login Details Not Exist.');
        }
    }

    public function forgot_password_view()
    {
        return view('auth.forgot_password');
    }
    public function forgot_password_post(Request $req)
    {
        $req->validate([
            'email' => 'required|exists:users,email'
        ], [
            'email.exists' => 'This email address is not registered.'
        ]);
        $user = User::where('email', $req->email)->first();
        if ($user) {
            $tokenAvail = ResetPassword::where('email', $req->email)->first();
            $token = md5(time() . $user->email . $user->name);
            $expireTime = Carbon::now()->addMinutes(30);
            if ($tokenAvail) {
                $tokenAvail->token = $token;
                $tokenAvail->expire = $expireTime;
                $tokenAvail->update();
            } else {
                $resetLink = new ResetPassword();
                $resetLink->email = $user->email;
                $resetLink->token = $token;
                $resetLink->expire = $expireTime;
                $resetLink->save();
            }

            $data = [
                'token' => $token
            ];
            Mail::send('mail.forgot-password', $data, function ($message) use ($user) {
                $message->to($user->email, $user->name)
                    ->subject($user->name . ' - Reset Password Mail');
            });
            return redirect()->route('login')->with('success', 'Your Reset Password Link Has Been Sent Your Mail Address.');
        } else {
            return redirect()->back()->with('failed', 'Email Not Found.');
        }
    }
    public function reset_password_view($token)
    {
        $checkToken = ResetPassword::where('token', $token)->first();
        if ($checkToken) {
            $currentTime = Carbon::now();
            if ($checkToken->expire > $currentTime) {
                return view('auth.reset_password', compact('checkToken'));
            } else {
                return redirect()->route('login')->with('failed', 'Token Expired.');
            }
        } else {
            return redirect()->route('login')->with('failed', 'Token mis match.');
        }
    }
    public function reset_password_post(Request $req)
    {
        $req->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required|min:8',
            'con_password' => 'required|min:8|same:password'
        ], [
            'email.exists' => 'You are wrong user or unauthorized access.',
            'password.min' => 'The password must be at least 8 characters.',
            'con_password.min' => 'The confirm password must be at least 8 characters.',
        ]);
        $user = User::where('email', $req->email)->first();
        $user->password = Hash::make($req->password);
        $user->update();
        ResetPassword::where('email', $req->email)->first()->delete();
        return redirect()->route('login')->with('success', "Dear! $user->name your password successfully changed. Please login your account using new password.");
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }
}
