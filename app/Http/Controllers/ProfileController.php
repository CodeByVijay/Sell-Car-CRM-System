<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function changeProfileImage(Request $req)
    {
        $req->validate([
            'profile_img' => 'required|mimes:png,jpg,jpeg'
        ]);
        $profile_image = User::find(auth()->user()->id);
        $file = $req->has('profile_img');
        if ($file) {
            $destination = 'admin/src/images/';
            $image = $req->file('profile_img');
            if ($profile_image->image != null) {
                $oldImg = $destination . '' . $profile_image->image;
                unlink($oldImg);
            }
            $imageName = time() . "-$profile_image->name-profile-image." . $image->extension();
            $image->move($destination, $imageName);
            $profile_image->image = $imageName;
            $profile_image->update();
            return redirect()->back()->with('success', "Dear! $profile_image->name Profile image successfully updated.");
        }
    }
    public function changeProfileInfo(Request $req)
    {
        $req->validate([
            'title' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.auth()->user()->id,
            'gender'=> 'required',
            'country'=> 'required',
            'state'=> 'required',
            'postcode'=> 'required',
            'mobile'=> 'required|unique:users,mobile,'.auth()->user()->id,
            'address'=> 'required',
            'date_of_birth'=> 'required',

        ],[
            'date_of_birth.required'=>'The Date of birth field is required.'
        ]);

        $user = User::find(auth()->user()->id);
        $user->title = $req->title;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->gender = $req->gender;
        $user->country = $req->country;
        $user->state = $req->state;
        $user->postcode = $req->postcode;
        $user->mobile = $req->mobile;
        $user->address = $req->address;
        $user->date_of_birth = $req->date_of_birth;
        $user->update();
        return redirect()->back()->with('success', "Dear! $user->name Your profile successfully updated.");
    }
    public function changePassword(Request $req)
    {
        $req->validate([
            'password' => 'required',
            'newPassword' => 'required|min:8',
            'con_password' => 'required|min:8|same:newPassword',

        ], [
            'newPassword.min' => 'The new password must be at least 8 characters.',
            'con_password.min' => 'The confirm password must be at least 8 characters.',
            'con_password.same' => 'The confirm password same the new password.',
        ]);
        $user = User::find(auth()->user()->id);
        if (Hash::check($req->password, $user->password)) {
            $user->password = Hash::make($req->password);
            $user->update();
            return redirect()->back()->with('success', "Dear! $user->name Your password successfully updated.");
        } else {
            return redirect()->back()->with('failed', "Dear! $user->name Your current password is wrong.");
        }
    }
}
