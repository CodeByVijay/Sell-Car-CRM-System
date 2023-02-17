<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Valuation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function loadData(Request $request)
    {
        if ($request->option == 'all') {
            $valuations = Valuation::orderBy('id', 'desc')->get();
            $valuation_count = Valuation::count();
            if ($valuation_count > 0) {
                return response()->json(["msg" => "success", "data" => $valuations, "count" => $valuation_count, "option" => $request->option,"test"=>"ifPart"]);
            } else {
                return response()->json(["msg" => "faild", "data" => null, "count" => "0"]);
            }
        } else {
            $valuations = Valuation::where('status', "$request->option")->orderBy('id', 'desc')->get();
            $valuation_count = Valuation::where('status', "$request->option")->count();
            if ($valuation_count > 0) {
                return response()->json(["msg" => "success", "data" => $valuations, "count" => $valuation_count, "option" => $request->option,"test"=>"elsePart"]);
            } else {
                return response()->json(["msg" => "faild", "data" => null, "count" => "0"]);
            }
        }
    }
}
