<?php

namespace App\Http\Controllers\Api\Auth\v1\Patient;

use App\Helper\ResponseHelper;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PatientProfileResource;
use App\Traits\MakeSlug;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use MakeSlug;
    //login
    public function login(Request $request)
    {
        $rules = [
            'email_or_phone' => 'required',
            'password' => 'required|string|min:6',
        ];

        if (filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL)) {
            $rules['email_or_phone'] = 'required|email|exists:patients,email';
            $patient = Patient::where('email',$request->email_or_phone)->first();
        } else {
            $rules['email_or_phone'] = 'required|exists:patients,phone';
            $patient = Patient::where('phone',$request->email_or_phone)->first();
        }
        $request->validate($rules);

        if (!$patient || ! Hash::check($request->password, $patient->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $patient->createToken('Booking')->plainTextToken;
        $data = [
            'user'=>new PatientProfileResource($patient),
            'token'=>$token
        ];
        return ResponseHelper::success($data,'Login successful!');
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
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

        try {
            $patient = Patient::create([
                'name'=>$request->name,
                'slug'=>$this->makeSlug($request->name,'patients'),
                'email'=>$email,
                'phone'=>$phone,
                'password'=>$request->password
            ]);
            $token =  $patient->createToken('Booking')->plainTextToken;
            $data = [
                'user' => new PatientProfileResource($patient),
                'token' => $token
            ];

            return ResponseHelper::success($data,'Successfully register account!');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ResponseHelper::success('success');
    }
}
