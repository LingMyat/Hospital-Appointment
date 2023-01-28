<?php

namespace App\Http\Controllers\Patient;

use App\Helper\PatientAuth;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\MakeSlug;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use MakeSlug;
    //loginPage
    public function loginPage(Request $request)
    {
        return view('Patient.auth.login');
    }

    //login
    public function login(Request $request)
    {
        $request->validate([
          'email_or_phone'=>'required',
          'password'=>'required'
        ]);

        if (filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL)) {
            $patient = Patient::where('email',$request->email_or_phone)->get()->first();
        } else {
            $patient = Patient::where('phone',$request->email_or_phone)->get()->first();
        }

        if (empty($patient)) {
            return back()->with('error','Your Account is Not Registered!');
        }
        elseif (!Hash::check($request->password, $patient->password))
        {
            return back()->with('error','The Credentials Does Not Match!');
        }

        PatientAuth::login($patient);
        return to_route('HOME')->with('success','Successfully Logged In Account!');
    }

    //registerPage
    public function registerPage(Request $request)
    {
        return view('Patient.auth.register');
    }

    //register
    public function register(Request $request)
    {
        $rules = [
            'name'=>'required|max:255',
            'password'=>'required',
            'confirm_password'=>'required|same:password'
        ];
        if (filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL)) {
            $rules['email_or_phone'] = 'required|email|unique:patients,email';
            $email = $request->email_or_phone;
            $phone = Null;
        } else {
            $rules['email_or_phone'] = 'required|unique:patients,phone';
            $phone = $request->email_or_phone;
            $email = Null;
        }
        $request->validate($rules);

        $patient = Patient::create([
            'name'=>$request->name,
            'slug'=>$this->makeSlug($request->name,'patients'),
            'email'=>$email,
            'phone'=>$phone,
            'password'=>$request->password
        ]);

        PatientAuth::login($patient);
        return to_route('HOME')->with('success','Successfully Register Account!');
    }

    //logout
    public function logout(Request $request)
    {
        PatientAuth::logout();
        return to_route('HOME')->with('success', 'Successfully Logged Out From Your Account!');
    }
}
