<?php

namespace App\Http\Controllers\Api\v1\Patient;

use App\Helper\ResponseHelper;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PatientAppointmentResource;

class AppointmentController extends Controller
{
    //index
    public function index(Request $request)
    {
        $appointments = Appointment::patientIn($request->user()->id)
            ->with('patient', 'doctor', 'doctorTime')
            ->orderBy('id', 'desc')
            ->get();
        if($request->appointment_id)
        {
            return ResponseHelper::success(new PatientAppointmentResource(Appointment::findOrFail($request->appointment_id)));
        }
        return ResponseHelper::success(PatientAppointmentResource::collection($appointments));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required',
            'address' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'disease' => 'required'
        ]);
    }
}
