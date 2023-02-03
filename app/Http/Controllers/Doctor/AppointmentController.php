<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\DoctorTime;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    //index
    public function index(Request $request)
    {
        $appointments = Appointment::doctorIn(doctorAuth()->id)
            ->with('patient', 'doctorTime', 'disease')
            ->get();
        return view('Doctor.page.Appointment.index', compact('appointments'));
    }
    //show
    public function show(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('Doctor.page.Appointment.show', compact('appointment'));
    }

    public function statusForm(Request $request,$appointment_id)
    {
        $appointment = Appointment::findOrFail($appointment_id);
        return view('Doctor.page.Appointment.status-edit-form',compact('appointment'));
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        if ($request->status == 'success') {
            $doctorTime = DoctorTime::findOrFail($appointment->doctor_time_id);
            $lastSuccessAppointment = Appointment::doctorIn(
                $appointment->doctor_id ?? $doctorTime->doctor_id
            )->doctorTimeIn(
                $appointment->doctor_time_id ?? $doctorTime->id
            )->where([
                'status' => 'success'
            ])->orderBy(
                'id','desc'
            )->first();
            $time = $doctorTime->time_from;
            if ($lastSuccessAppointment) {
                $time = date('H:i', strtotime($lastSuccessAppointment->time) + 1200);
            }

            $appointment->update([
                'status'=>'success',
                'time'=>$time
            ]);

        } elseif ($request->status == 'canceled') {
            $appointment->update([
                'status' => 'canceled',
                'cancel_remark'=>$request->cancel_remark
            ]);
        }
        return redirect()->back()->with('success','Successfully Updated!');
    }

    //success
    public function success(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $doctorTime = DoctorTime::findOrFail($appointment->doctor_time_id);
        $lastSuccessAppointment = Appointment::doctorIn(
            $appointment->doctor_id ?? $doctorTime->doctor_id
        )->doctorTimeIn(
            $appointment->doctor_time_id ?? $doctorTime->id
        )->where([
            'status' => 'success'
        ])->orderBy(
            'id','desc'
        )->first();
        $time = $doctorTime->time_from;
        if ($lastSuccessAppointment) {
            $time = date('H:i', strtotime($lastSuccessAppointment->time) + 1200);
        }

        $appointment->update([
            'status'=>'success',
            'time'=>$time
        ]);
        session()->put('success','Successfully Updated');
        return response()->json('success', 200);
    }

    //cancel
    public function cancel(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $doctor = $appointment->doctorTime->doctor;
        $appointment->update([
            'status' => 'canceled',
            'cancel_remark'=>"ဤချိန်းဆိုမှုအပိုင်းသည် လူပြည့်သွားပါပြီ။ ဤအပိုင်းကို နောက်အပတ်တွင် ပြန်လည်စတင်ပါမည် သို့မဟုတ် ဒေါက်တာ $doctor->name ၏ နောက်ထပ်ချိန်းဆိုမှုကို ကြိုးစားကြည့်ပါ။"
        ]);
        session()->put('success','Successfully Updated');
        return response()->json('success', 200);
    }
}
