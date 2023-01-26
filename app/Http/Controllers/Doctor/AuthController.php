<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Doctor;
use App\Helper\DoctorAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\MakeSlug;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use MakeSlug;
    //loginPage
    public function loginPage(Request $request)
    {
        return view('Doctor.auth.login');
    }

    //login
    public function login(Request $request)
    {
        $request->validate([
          'email_or_phone'=>'required',
          'password'=>'required'
        ]);

        if (filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL)) {
            $doctor = Doctor::where('email',$request->email_or_phone)->get()->first();
        } else {
            $doctor = Doctor::where('phone',$request->email_or_phone)->get()->first();
        }

        if (empty($doctor)) {
            return back()->with('error','Your Account is Not Registered!');
        }
        elseif (!Hash::check($request->password, $doctor->password))
        {
            return back()->with('error','The Credentials Does Not Match!');
        }

        DoctorAuth::login($doctor);
        return to_route('doctor.dashboard')->with('success','Successfully Logged In Account!');
    }

    //registerPage
    public function registerPage(Request $request)
    {
        return view('Doctor.auth.register');
    }

    //register
    public function register(Request $request)
    {
        $rules = [
            'name'=>'required',
            'password'=>'required',
            'confirm_password'=>'required|same:password'
        ];
        if (filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL)) {
            $rules['email_or_phone'] = 'required|email|unique:doctors,email';
            $email = $request->email_or_phone;
            $phone = Null;
        } else {
            $rules['email_or_phone'] = 'required|unique:doctors,phone';
            $phone = $request->email_or_phone;
            $email = Null;
        }
        $request->validate($rules);
        $doctor = Doctor::create([
            'name'=>$request->name,
            'slug'=>$this->makeSlug($request->name,'doctors'),
            'email'=>$email,
            'phone'=>$phone,
            'password'=>$request->password
        ]);

        DoctorAuth::login($doctor);
        return to_route('doctor.dashboard')->with('success','Successfully Register Account!');
    }

    //logout
    public function logout(Request $request)
    {
        DoctorAuth::logout();
        return to_route('doctor.loginPage')->with('success', 'Successfully Logged Out From Your Account!');
    }

    //profile update
    public function update(Request $request)
    {
        dd($request->all());
    }
}
