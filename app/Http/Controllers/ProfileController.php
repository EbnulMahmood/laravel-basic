<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Image;
use Auth;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function UpdateProfile()
    {
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            if ($user) {
                return view('admin.profile.update_profile', compact('user'));
            }
        }
        return Redirect()->back()->with('message', 'User not found!')->with('alert', 'warning');
    }

    public function UpdateUserProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if ($user) {
            $image = $request->file('image');

            if ($image) {
                $upload_location = 'storage/profile-photos/';
                $old_image = $request->old_image;
        
                $image_name = hexdec(uniqid()).'.'.strtolower($image->getClientOriginalExtension());
                $last_image = $upload_location.$image_name;
                Image::make($image)->resize(500, 500)->save($last_image);

                unlink($old_image);
                $user->name = $request['name'];
                $user->email = $request['email'];
                $user->profile_photo_path = $last_image;
                $user->save();
                return Redirect()->back()->with('message', 'User updated successfully!')->with('alert', 'success');

            } else {
                $user->name = $request['name'];
                $user->email = $request['email'];
                $user->save();
                return Redirect()->back()->with('message', 'User updated successfully!')->with('alert', 'success');
            }
        }
        return Redirect()->back()->with('message', 'User not found!')->with('alert', 'warning');
    }
}
