<?php

namespace App\Http\Controllers\Api\v1\Patient;

use App\Models\DoctorTime;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\PatientAppointmentResource;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::patientIn($request->user()->id)
        ->with('patient', 'doctor', 'doctorTime')
        ->orderBy('id', 'desc');
        if ($request->status) {
            $query->where('status',$request->status);
        }
        $appointments = $query->get();
        if ($request->appointment_id) {
            return ResponseHelper::success(new PatientAppointmentResource(Appointment::findOrFail($request->appointment_id)));
        }
        return ResponseHelper::success(PatientAppointmentResource::collection($appointments));
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'name' => 'required|max:255',
            // 'phone' => 'required',
            // 'address' => 'required',
            // 'date_of_birth' => 'required',
            // 'gender' => 'required',
            'diagnosis_id' => 'required',
            'doctor_time_id' => 'required'
        ]);
        $time = DoctorTime::findOrFail($request->doctor_time_id);
        $pending = Appointment::doctorIn($time->doctor->id)
            ->doctorTimeIn(
                $time->id ?? $request->doctor_time_id
            )->patientIn(
                $request->user()->id
            )->where('status', 'pending')->first();
        $success = Appointment::doctorIn($time->doctor->id)
            ->doctorTimeIn(
                $time->id ?? $request->doctor_time_id
            )->patientIn(
                $request->user()->id
            )->where('status', 'success')->first();

        if ($pending) {
            return response()->json('Your appointment is processing please wait for success!',200);
        }
        if ($success) {
            return response()->json('Your appointment is success check your appointments page!',200);
        }

        if (isAppointmentAvaliabe($time->doctor->id,$time->id ?? $request->doctor_time_id)) {
            Appointment::create([
                'patient_id' => $request->user()->id,
                'doctor_id' => $time->doctor->id,
                'doctor_time_id' => $time->id ?? $request->doctor_time_id,
                'disease_id' => $request->diagnosis_id,
                'note' => $request->note,
            ]);
            return response()->json('Your appointment is processing please wait for success!',200);
        }
        return response()->json("ဤချိန်းဆိုမှုအပိုင်းသည် လူပြည့်သွားပါပြီ။ ဤအပိုင်းကို နောက်အပတ်တွင် ပြန်လည်စတင်ပါမည် သို့မဟုတ် ဒေါက်တာ {$time->doctor->name} ၏ နောက်ထပ်ချိန်းဆိုမှုကို ကြိုးစားကြည့်ပါ။!",422);
    }
}
