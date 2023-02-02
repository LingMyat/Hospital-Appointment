<?php

namespace App\Http\Controllers\Patient;

use App\Helper\PatientAuth;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Nrc;
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
            $patient = Patient::where('email',$request->email_or_phone)->first();
        } else {
            $patient = Patient::where('phone',$request->email_or_phone)->first();
        }

        if (empty($patient)) {
            return back()->with('error','Your Account is Not Registered!');
        }
        elseif (!Hash::check($request->password, $patient->password))
        {
            return back()->with('error','The Credentials Does Not Match!');
        }

        PatientAuth::login($patient);
        if ($request->redirect) {
            return redirect($request->redirect)->with('success', 'Successfully login to your account!');
        }
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

    //updateProfile
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email',
            'phone'=>'required',
            'address'=>'required',
            'date_of_birth'=>'required',
            'image'=>'mimes:png,jpg,jpeg'
        ]);

        $requestData = $request->all();

        if($request->hasFile('image')){
            $path = Patient::UPLOAD_PATH."/" . date("Y") . "/" . date("m") . "/";
            $fileName = uniqid().time().'.'.$request->image->extension();
            $request->image->move(public_path($path), $fileName);
            $requestData['image'] = $path . $fileName;
        }

        $requestData['NRC'] = $request->nrc_number;
        if ($request->nrc_name) {
            if (!in_array(null,[$request->nrc_code,$request->mid_txt,$request->nrc_name,$request->nrc_number])) {
                $nrc = Nrc::where([
                    'nrc_code'=>$request->nrc_code,
                    'name_mm'=>$request->nrc_name
                ])->first();
                $requestData['NRC'] = $request->nrc_number;
                $requestData['nrc_id'] = $nrc->id;
            }
        }

        Patient::findOrFail(patientAuth()->id)->update($requestData);
        return redirect()->back()->with('success','Successfully updated profile!');
    }
}
