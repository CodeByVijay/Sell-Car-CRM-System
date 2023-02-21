<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Valuation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        $data['total_leads'] = Valuation::count();
        $data['pending_leads'] = Valuation::where(['status'=>'pending','assign_to'=>auth()->user()->id])->count();
        $data['progress_leads'] = Valuation::where(['status'=>'in-progress','assign_to'=>auth()->user()->id])->count();
        $data['completed_leads']= Valuation::where(['status'=>'delivered','assign_to'=>auth()->user()->id])->count();
        $data['employees'] = User::where('is_admin', 0)->get();

        $data['completedData']= Valuation::select(DB::raw("(COUNT(id)) as count"),DB::raw("MONTHNAME(created_at) as monthname"))
        ->whereYear('created_at', date('Y'))
        ->groupBy('monthname')
        // ->orderBy('monthname','asc')
        ->get()->toArray();

        $allLeadsData = [];
        foreach($data['completedData'] as $row) {
           $allLeadsData['label'][] = $row['monthname'];
           $allLeadsData['data'][] = (int) $row['count'];
         }

         $data['allLeads'] = json_encode($allLeadsData);

        return view('admin.home', $data);
    }
}
