<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Login
    public function loginPage(Request $request)
    {
        return view('Admin.auth.login');
    }

    //login
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $user = User::where('email',$request->email)->get()->first();
        if (empty($user)) {
            return back()->with('error','This Acc is Not Admin!');
        }
        elseif (!Hash::check($request->password, $user->password))
        {
            return back()->with('error','The Credentials Does Not Match!');
        }
        Auth::login($user);
        return to_route('admin.dashboard')->with('success','Successfully Logged In');
    }

    //logout
    public function logout(Request $request)
    {
        Auth::logout(auth()->user());
        return to_route('welcome');
    }

}
