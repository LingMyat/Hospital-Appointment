<?php

namespace App\Http\Controllers\Api\v1;

use App\Helper\ResponseHelper;
use App\Models\Doctor;
use App\Models\Disease;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;

class DoctorController extends Controller
{
    //doctors
    public function doctors(Request $request)
    {
        $query = Doctor::active()->with('Specialities');
        if($request->search)
        {
            $query->where('name','like',"%$request->search%");
        }
        $doctors = $query->get();
        if ($request->diagnosis_id) {
            $disease = Disease::where('id',$request->diagnosis_id)->with('doctors','parent')->get()->first();
            $doctors = $disease->doctors;
        } elseif ($request->doctor_id) {
            $doctor = Doctor::findOrFail($request->doctor_id);
            return ResponseHelper::success(new DoctorResource($doctor));
        }
        return ResponseHelper::success(DoctorResource::collection($doctors));
    }
}
