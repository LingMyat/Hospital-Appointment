<?php

namespace App\Http\Controllers\Api\Auth\v1\Doctor;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use App\Traits\MakeSlug;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use MakeSlug;
    public function login(Request $request)
    {
        $rules = [
            'email_or_phone' => 'required',
            'password' => 'required|string|min:6',
        ];

        if (filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL)) {
            $rules['email_or_phone'] = 'required|email|exists:doctors,email';
            $doctor = Doctor::where('email',$request->email_or_phone)->first();
        } else {
            $rules['email_or_phone'] = 'required|exists:doctors,phone';
            $doctor = Doctor::where('phone',$request->email_or_phone)->first();
        }
        $request->validate($rules);

        if (!$doctor || ! Hash::check($request->password, $doctor->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $doctor->createToken('Booking')->plainTextToken;
        $data = [
            'user'=>new DoctorResource($doctor),
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
            $rules['email_or_phone'] = 'required|email|unique:doctors,email';
            $email = $request->email_or_phone;
            $phone = Null;
        } else {
            $rules['email_or_phone'] = 'required|unique:doctors,phone';
            $phone = $request->email_or_phone;
            $email = Null;
        }

        $request->validate($rules);

        try {
            $doctor = Doctor::create([
                'name'=>$request->name,
                'slug'=>$this->makeSlug($request->name,'doctors'),
                'email'=>$email,
                'phone'=>$phone,
                'password'=>$request->password
            ]);
            $token =  $doctor->createToken('Booking')->plainTextToken;
            $data = [
                'user' => new DoctorResource($doctor),
                'token' => $token
            ];

            return ResponseHelper::success($data,'Successfully register account!');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
