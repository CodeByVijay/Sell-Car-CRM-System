<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Models\Valuation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function home()
    {
        $data['total_leads'] = Valuation::count();
        $data['pending_leads'] = Valuation::where('status', 'pending')->count();
        $data['progress_leads'] = Valuation::where('status', 'in-progress')->count();
        $data['completed_leads'] = Valuation::where('status', 'delivered')->count();
        $data['employees'] = User::where(['is_admin' => 0, 'status' => 1])->get();

        $data['completedData'] = Valuation::select(DB::raw("(COUNT(id)) as count"), DB::raw("MONTHNAME(created_at) as monthname"))
            ->whereYear('created_at', date('Y'))
            ->groupBy('monthname')
            // ->orderBy('monthname','asc')
            ->get()->toArray();

        $allLeadsData = [];
        foreach ($data['completedData'] as $row) {
            $allLeadsData['label'][] = $row['monthname'];
            $allLeadsData['data'][] = (int) $row['count'];
        }

        $data['allLeads'] = json_encode($allLeadsData);

        return view('admin.home', $data);
    }
    public function loadData(Request $request)
    {
        if ($request->option == 'all') {
            $valuations = Valuation::leftjoin('users', 'users.id', '=', 'valuations.assign_to')->select('valuations.*', 'users.title as emp_title', 'users.name as emp_name')->orderBy('valuations.id', 'desc')->get();
            $valuation_count = Valuation::count();
            if ($valuation_count > 0) {
                return response()->json(["msg" => "success", "data" => $valuations, "count" => $valuation_count, "option" => $request->option]);
            } else {
                return response()->json(["msg" => "faild", "data" => null, "count" => "0", 'test' => '1']);
            }
        } else {
            $valuations = Valuation::leftjoin('users', 'users.id', '=', 'valuations.assign_to')->where('valuations.status', "$request->option")->select('valuations.*', 'users.title as emp_title', 'users.name as emp_name')->orderBy('valuations.id', 'desc')->get();
            $valuation_count = Valuation::where('status', "$request->option")->count();
            if ($valuation_count > 0) {
                return response()->json(["msg" => "success", "data" => $valuations, "count" => $valuation_count, "option" => $request->option]);
            } else {
                return response()->json(["msg" => "faild", "data" => null, "count" => "0", 'test' => '2']);
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

    public function assignLead(Request $req)
    {
        $emp_id = $req->emp_id;
        if (is_array($req->all_leads)) {
            $leads = $req->all_leads;

            $leadData = Valuation::whereIn('id', $leads)->get();
            foreach ($leadData as $row) {
                $data = [
                    'user_id' => $emp_id,
                    'sender_id' => auth()->user()->id,
                    'sender_name' => ucfirst(auth()->user()->name),
                    'subject' => $row->registration . ' - Assign you.',
                    'msg' => 'Please check all details & process this lead.',
                    'status' => 0,
                ];
                Notification::create($data);
            }
            Valuation::whereIn('id', $leads)->update([
                'assign_to' => $emp_id
            ]);
        } else {
            $lead = $req->lead_id;
            $leadData = Valuation::find($lead);
            $data = [
                'user_id' => $emp_id,
                'sender_id' => auth()->user()->id,
                'sender_name' => ucfirst(auth()->user()->name),
                'subject' => $leadData->registration . ' - Assign you.',
                'msg' => 'Please check all details & process this lead.',
                'status' => 0,
            ];
            Notification::create($data);
            $leadData->assign_to = $emp_id;
            $leadData->update();
        }

        return response()->json(["msg" => "success"]);
    }

    // Trash Leads
    public function archiveLead(Request $req)
    {
        if (is_array($req->leads)) {
            $leads = $req->leads;
            Valuation::whereIn('id', $leads)->delete();
        } else {
            $lead = $req->lead_id;
            Valuation::find($lead)->delete();
        }

        return response()->json(["msg" => "success"]);
    }

    // Get all archive leads
    public function getArchiveLeads()
    {
        $data['archivedLeads'] = Valuation::onlyTrashed()->get();
        return view('admin.leads.archive-lead', $data);
    }

    public function restoreArchiveLeads(Request $req)
    {
        // echo "<pre>";
        // print_r($req->all());
        // echo "<pre>";
        // die();
        if ($req->leads == 'all') {
            Valuation::onlyTrashed()->restore();
        } else {
            $lead = $req->lead_id;
            Valuation::onlyTrashed()->find($lead)->restore();
        }
        return redirect()->back()->with('success', "Lead Restored Successfully.");
    }

    public function deleteArchiveLeads(Request $req)
    {
        if ($req->leads == 'all') {
            Valuation::onlyTrashed()->forcedelete();
        } else {
            $lead = $req->lead_id;
            Valuation::onlyTrashed()->find($lead)->forcedelete();
        }

        return redirect()->back()->with('success', "Lead Deleted Successfully.");
    }
}
