<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    //show
    public function show(Request $request, $slug)
    {
        $doctor = Doctor::where('slug',$slug)->active()->with('Specialities')->get()->first();
        return view('Patient.page.doctors.show',compact('doctor'));
    }
}
