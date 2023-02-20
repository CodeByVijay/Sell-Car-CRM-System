<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Valuation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $data['total_leads'] = Valuation::count();
        $data['pending_leads'] = Valuation::where(['status'=>'pending','assign_to'=>auth()->user()->id])->count();
        $data['progress_leads'] = Valuation::where(['status'=>'in-progress','assign_to'=>auth()->user()->id])->count();
        $data['completed_leads']= Valuation::where(['status'=>'delivered','assign_to'=>auth()->user()->id])->count();
        $data['employees'] = User::where('is_admin', 0)->get();
        return view('admin.home', $data);
    }
}
