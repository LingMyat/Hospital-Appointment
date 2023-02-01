<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\DoctorTime;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    //create
    public function create(Request $request,$id)
    {
        $time = DoctorTime::findOrFail($id);
        return view('Patient.Layout.Template.share.modal.appointment-form-modal',compact('time'));
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'phone'=>'required',
            'address'=>'required',
            'date_of_birth'=>'required',
            'gender'=>'required',
            'disease'=>'required'
        ]);

        if (!patientAppointmentCheck()) {
            Patient::findOrFail(patientAuth()->id)->update([
                'phone'=>$request->phone,
                'address'=>$request->address,
                'date_of_birth'=>$request->date_of_birth,
                'gender'=>$request->gender
            ]);
        }

        $time = DoctorTime::findOrFail($request->doctor_time_id);

        $last_appointment_of_doctor = Appointment::where([
            'doctor_id'=>$time->doctor->id,
            'doctor_time_id'=>$time->id??$request->doctor_time_id,
        ])->orderBy('id','desc')->first();

        $appointment_time = $time->time_from;

        if ($last_appointment_of_doctor) {
            $appointment_time = date('H:i',strtotime($last_appointment_of_doctor->time) + 1200);
        }
        if (strtotime($time->time_to) > strtotime($appointment_time)) {
                Appointment::create([
                    'patient_id'=>patientAuth()->id,
                    'doctor_id'=>$time->doctor->id,
                    'doctor_time_id'=>$time->id??$request->doctor_time_id,
                    'disease_id'=>$request->disease,
                    'note'=>$request->note,
                    'time'=>$appointment_time
                ]);
                return redirect()->back()->with('success','Your appointment is processing please wait for success!');
        }
    }
}
