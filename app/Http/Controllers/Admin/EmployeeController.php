<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MailSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    public function listAllEmployee()
    {
        $data['employees'] = User::where('is_admin', 0)->get();
        return view('admin.employee.employees', $data);
    }

    public function addEditEmployee(Request $req)
    {
        $msg = '';
        if ($req->emp_id) {
            $employee = User::find($req->emp_id);
            $msg = 'Updated';
        } else {
            $req->validate([
                'title' => 'required',
                'name' => 'required',
                'mobile_no' => 'required|unique:users,mobile',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'date_of_birth' => 'required',
                'gender' => 'required',
            ]);
            $employee = new User();
            $msg = 'Added';


        }

        $employee->title = $req->title;
        $employee->name = ucfirst($req->name);
        $employee->email = $req->email;
        $employee->mobile = $req->mobile_no;
        $employee->password = $req->password ? Hash::make($req->password) : $employee->password;
        $employee->date_of_birth = $req->date_of_birth;
        $employee->gender = $req->gender;
        $employee->address = $req->address;
        $employee->state = $req->state;
        $employee->country = $req->country;
        $employee->postcode = $req->postcode;
        $employee->save();

        $mailData = MailSetting::where('status',1)->first();
        if($mailData){
            $data = [
                'name'=>$req->title.' '.ucfirst($req->name),
                'email'=>$req->email,
                'mobile'=>$req->mobile,
                'password'=>$req->password,
                'gender'=>$req->gender,
                'from_address'=>$mailData->from_address,
                'from_name'=>$mailData->from_name,
            ];

            if($msg == 'Added'){
                Mail::send('mail.welcome', $data, function ($message) use ($data) {
                    $message->to($data['email'], $data['name'])
                        ->subject($data['name'].' - Welcome to team (Sell Car Company).');
                    $message->from($data['from_address'], $data['from_name']);
                });
            }
        }

        return redirect()->route('admin.listAllEmployee')->with('success', ucfirst($req->name) . ' - Employee Has Been  ' . $msg . ' Successfully.');
    }

    public function employeeStatus(Request $req)
    {
        $employee = User::find($req->empId);
        $employee->status = $employee->status == 0 ? 1 : 0;
        $employee->update();
        return response()->json(['msg' => 'success', 'status' => $employee->status]);
    }

    public function empEdit($id)
    {
        $employee = User::find($id);
        return view('admin.employee.editEmp', compact('employee'));
    }

    public function empPasswordChange(Request $req){
        $emp = User::find($req->emp_id);
        $emp->password = Hash::make($req->password);
        $emp->update();
        return response()->json(['msg'=>"success"]);
    }

    public function empDelete($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.listAllEmployee')->with('success', 'Employee Has Beed Deleted.');
    }

    public function loginAsEmployee($id){
        Auth::loginUsingId($id);
        return redirect()->intended(route('employee.home'));
    }

}
