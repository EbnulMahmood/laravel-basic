<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function ChangePassword()
    {
        return view('admin.password.change_password');
    }

    public function UpdatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->current_password, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return Redirect()->route('login')->with('message', 'Password updared successfully!')->with('alert', 'success');
        } else {
            return Redirect()->back()->with('message', 'Something went wrong. Please try again!')->with('alert', 'danger');
        }
    }
}
