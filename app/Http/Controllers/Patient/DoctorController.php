<?php

namespace App\Http\Controllers\Patient;

use App\Models\Day;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    //show
    public function show(Request $request, $slug)
    {
        $doctor = Doctor::where('slug',$slug)->active()->with('Specialities')->first();
        return view('Patient.page.doctors.show',compact('doctor'));
    }

    //doctorTimes
    public function doctorTimes(Request $request,$slug)
    {
        $doctor = Doctor::where('slug',$slug)->active()->first();
        $days = Day::with('doctorTimes')->get();
        return view('Patient.Layout.Template.share.modal.appointment-time-modal',compact('doctor','days'));
    }
}
