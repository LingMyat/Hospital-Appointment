<?php

namespace App\Http\Controllers\Api\Auth\v1\Patient;

use App\Models\Nrc;
use App\Models\Patient;
use App\Traits\MakeSlug;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\PatientProfileResource;
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
        return ResponseHelper::success();
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email',
            'phone'=>'required',
            'address'=>'required',
            'date_of_birth'=>'required',
            'image'=>'mimes:png,jpg,jpeg',
            'nrc_code'=>'required',
            'name_mm'=>'required',
            'nrc_number'=>'required|max:6'
        ]);
        $requestData = $request->all();
        if($request->hasFile('image')){
            $path = Patient::UPLOAD_PATH."/" . date("Y") . "/" . date("m") . "/";
            $fileName = uniqid().time().'.'.$request->image->extension();
            $request->image->move(public_path($path), $fileName);
            $requestData['image'] = $path . $fileName;
        }
        $nrc = Nrc::where([
            'nrc_code'=>$request->nrc_code,
            'name_mm'=>$request->name_mm
        ])->first();
        $requestData['NRC'] = $request->nrc_number;
        $requestData['nrc_id'] = $nrc->id;
        Patient::findOrFail($request->user()->id)->update($requestData);
        return response()->json('Updated Successful!',200);
    }
}
