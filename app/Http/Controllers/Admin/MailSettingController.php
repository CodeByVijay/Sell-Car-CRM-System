<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MailSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MailSettingController extends Controller
{
    public function index()
    {
        $data['mailSettings'] = MailSetting::orderBy('id', 'asc')->get();
        return view('admin.mail-setting', $data);
    }

    public function addEditMailSetting(Request $req)
    {
        $req->validate([
            'mailer' => 'required',
            'host' => 'required',
            'encryption' => 'required',
            'port' => 'required',
            'username' => 'required',
            'password' => 'required|min:6',
            'from_address' => 'required',
            'from_name' => 'required',
        ]);
        if ($req->mail_id) {
            $mail = MailSetting::find($req->mail_id);
            $msg = 'updated.';
        } else {
            $mail = new MailSetting();
            $msg = "created.";
        }

        $data = [
            'driver' => $req->mailer,
            'host' => $req->host,
            'port' => $req->port,
            'encryption' => $req->encryption,
            'username' => $req->username,
            'password' => $req->password,
            'from' => [
                'address' => $req->from_address,
                'name' => $req->from_name
            ]
        ];
        Config::set('mail', $data);

        try {

            $maildata = [
                'from' => $req->from_address,
                'name' => $req->from_name,
            ];

            Mail::send('mail.testMail', $maildata, function ($message) use ($maildata) {
                $message->to($maildata['from'], $maildata['name'])
                    ->subject('Sell Car CRM Testing Mail');
                $message->from($maildata['from'], $maildata['name']);
            });

            MailSetting::where('status', 1)->update([
                'status' => 0
            ]);
            $mail->mailer = $req->mailer;
            $mail->host = $req->host;
            $mail->encryption = $req->encryption;
            $mail->port = $req->port;
            $mail->username = $req->username;
            $mail->password = $req->password;
            $mail->from_address = $req->from_address;
            $mail->from_name = $req->from_name;
            $mail->status = 1;
            $mail->save();

            return redirect()->route('admin.mailSetting')->with('success', " Mail configuration successfully " . $msg);
        } catch (\Exception $e) {
            return redirect()->back()->with('faild', $e->getMessage());
        }
    }

    public function editMailSettingForm($id)
    {
        $mailSetting = MailSetting::find($id);
        return view('admin.editMailSetting', compact('mailSetting'));
    }

    public function useMailSetting($id)
    {
        MailSetting::where('status', 1)->update([
            'status' => 0
        ]);
        MailSetting::find($id)->update([
            'status' => 1
        ]);
        return redirect()->route('admin.mailSetting')->with('success', "Mail configuration successfully set further mail communications.");
    }

    public function deleteMailSetting($id)
    {
        MailSetting::find($id)->delete();
        return redirect()->route('admin.mailSetting')->with('success', "Mail configuration successfully delete.");
    }

    public function sendTestMail(Request $req)
    {
        try {
            $mail = MailSetting::where('status', 1)->first();
            $data = [
                'from' => $mail->from_address,
                'name' => $mail->from_name,
            ];

            Mail::send('mail.testMail', $data, function ($message) use ($data, $req) {
                $message->to($req->to, $req->name)
                    ->subject('Sell Car CRM Testing Mail');
                // $message->from($data['from'], $data['name']);
            });
            return redirect()->back()->with('success', 'Test email sent successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('faild', $e->getMessage());
        }
    }
}
