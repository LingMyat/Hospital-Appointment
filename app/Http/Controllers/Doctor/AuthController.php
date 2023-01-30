<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Doctor;
use App\Helper\DoctorAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DoctorProfession;
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
            $doctor = Doctor::where('email',$request->email_or_phone)->first();
        } else {
            $doctor = Doctor::where('phone',$request->email_or_phone)->first();
        }

        if (empty($doctor)) {
            return back()->with('error','Your Account is Not Registered!');
        }
        elseif (!Hash::check($request->password, $doctor->password))
        {
            return back()->with('error','The Credentials Does Not Match!');
        }

        DoctorAuth::login($doctor);
        if ($request->redirect) {
            return redirect($request->redirect)->with('success', 'Successfully Logged In Account!');
        }
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
        $data = [
            'name'=>$request->name,
            'slug'=>$this->makeSlug($request->name,'doctors'),
            'email'=>$request->email,
            'phone'=>$request->phone,
            'degree'=>$request->degree,
            'SAMA'=>$request->SAMA,
            'biography'=>$request->biography
        ];

        if($request->hasFile('image')){
            $path = Doctor::UPLOAD_PATH.date('Y').'/'.date('m')."/";
            $fileName = uniqid().time().'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path($path),$fileName);
            $data['image'] = ($path . $fileName);
        }

        Doctor::findOrFail(doctorAuth()->id)->update($data);

        if ($request->professions) {
            DoctorProfession::where('doctor_id',doctorAuth()->id)->delete();
            foreach ($request->professions as $key => $disease_id) {
                DoctorProfession::create([
                    'doctor_id'=>doctorAuth()->id,
                    'disease_id'=>$disease_id
                ]);
            }
        }

        return redirect()->back()->with('success','Successfully updated!');
    }
}
