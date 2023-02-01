<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
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
    public function show(Request $request,$id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('Doctor.page.Appointment.show',compact('appointment'));
    }
}
