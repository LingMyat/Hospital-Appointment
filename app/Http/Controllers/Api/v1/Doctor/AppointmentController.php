<?php

namespace App\Http\Controllers\Api\V1\Doctor;

use App\Models\DoctorTime;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorAppointmentResource;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointment::doctorIn($request->user()->id)
            ->with('patient', 'doctorTime', 'disease')
            ->get();
        return ResponseHelper::success(DoctorAppointmentResource::collection($appointments));
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->doctor_id <> $request->user()->id) {
            return ResponseHelper::fail();
        }

        if ($appointment->status == 'success') {
            return ResponseHelper::fail('This Appointment is already success!');
        } elseif ($appointment->status == 'canceled') {
            return ResponseHelper::fail('This Appointment is already canceled!');
        }

        if ($request->status == 'success') {

            $doctorTime = DoctorTime::findOrFail($appointment->doctor_time_id);
            $lastSuccessAppointment = Appointment::doctorIn(
                $appointment->doctor_id ?? $doctorTime->doctor_id
            )->doctorTimeIn(
                $appointment->doctor_time_id ?? $doctorTime->id
            )->where([
                'status' => 'success'
            ])->orderBy(
                'id',
                'desc'
            )->first();
            $time = $doctorTime->time_from;
            if ($lastSuccessAppointment) {
                $time = date('H:i', strtotime($lastSuccessAppointment->time) + 1200);
            }

            if (isAppointmentAvaliabe($appointment->doctor_id, $appointment->doctor_time_id)) {
                $appointment->update([
                    'status' => 'success',
                    'time' => $time
                ]);
                return response()->json('Successfully updated status', 200);
            }
            return ResponseHelper::fail('This Appointment section is full you need to cancel!');
        } else {
            $request->validate([
                'cancel_remark'=>'required'
            ]);
            $appointment->update([
                'status' => 'canceled',
                'cancel_remark' => $request->cancel_remark
            ]);
        }
        return response()->json('Successfully updated status', 200);
    }
}
