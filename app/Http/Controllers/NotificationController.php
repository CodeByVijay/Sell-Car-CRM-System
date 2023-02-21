<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $data['notifications'] = Notification::where('user_id', auth()->user()->id)->orWhere('user_id', 0)->get();
        $data['employees'] = User::get();
        return view('admin.notifications.notifications', $data);
    }
    public function sendNotification(Request $request)
    {
        $notification = new Notification();
        $notification->user_id = $request->emp_id;
        $notification->sender_id = auth()->user()->id;
        $notification->sender_name = ucfirst(auth()->user()->name);
        $notification->subject = $request->subject;
        $notification->msg = $request->msg;
        $notification->save();
        return redirect()->back()->with('success', 'Notification Has Beed Sent.');
    }

    public function deleteNotification($id)
    {
        Notification::find($id)->delete();
        return redirect()->back()->with('success', 'Notification Has Beed Deleted.');
    }
}
