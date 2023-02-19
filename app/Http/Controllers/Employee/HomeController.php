<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $data['employees'] = User::where('is_admin', 0)->get();
        return view('admin.home', $data);
    }
}
