<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                Auth::attempt($credentials);
                return redirect()->intended(route('admin.home'));
            } else if ($req->type == 'employee' && $user->is_admin == 0) {
                if ($user->status == 1) {
                    Auth::attempt($credentials);
                    return redirect()->intended(route('employee.home'));
                } else {
                    return redirect()->route('login')->with('faild', 'Are you blocked. Please contact Administrator.');
                }
            } else {
                return redirect()->route('login')->with('faild', 'Unauthorize Access. Please contact Administrator.');
            }
        } else {
            return redirect()->route('login')->with('faild', 'Your Login Details Not Exist.');
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }
}
