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

        $data['completedData']= Valuation::where('assign_to',auth()->user()->id)->select(DB::raw("(COUNT(id)) as count"),DB::raw("MONTHNAME(created_at) as monthname"))
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

    public function viewLeadPage(){
        return view('employee.leads.leads');
    }

    public function loadData(Request $request)
    {
        if ($request->option == 'all') {
            $valuations = Valuation::join('users', 'users.id', '=', 'valuations.assign_to')->where('users.id','=',auth()->user()->id)->select('valuations.*', 'users.title as emp_title', 'users.name as emp_name')->orderBy('valuations.id', 'desc')->get();
            $valuation_count = Valuation::where('assign_to','=',auth()->user()->id)->count();
            if ($valuation_count > 0) {
                return response()->json(["msg" => "success", "data" => $valuations, "count" => $valuation_count, "option" => $request->option]);
            } else {
                return response()->json(["msg" => "failed", "data" => null, "count" => "0"]);
            }
        } else {
            $valuations = Valuation::join('users', 'users.id', '=', 'valuations.assign_to')->where('users.id','=',auth()->user()->id)->where('valuations.status', "$request->option")->select('valuations.*', 'users.title as emp_title', 'users.name as emp_name')->orderBy('valuations.id', 'desc')->get();
            $valuation_count = Valuation::where('assign_to','=',auth()->user()->id)->where('status', "$request->option")->count();
            if ($valuation_count > 0) {
                return response()->json(["msg" => "success", "data" => $valuations, "count" => $valuation_count, "option" => $request->option]);
            } else {
                return response()->json(["msg" => "failed", "data" => null, "count" => "0"]);
            }
        }
    }


    public function changeValStatus(Request $req)
    {
        $val_status = Valuation::find($req->valuation_id);
        $val_status->status = $req->status;
        $val_status->update();
        return response()->json(["msg" => "success", "data" => $val_status]);
    }
}
